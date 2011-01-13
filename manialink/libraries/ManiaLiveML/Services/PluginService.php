<?php

namespace ManiaLiveML\Services;

class PluginService extends \ManiaLib\Services\AbstractService
{
	/**
	 * @return \ManiaLiveML\Services\Plugin
	 */
	function get($id)
	{
		$result = $this->db->execute(
			'SELECT * '.
			'FROM Plugins '.
			'WHERE id='.(int)$id );
		
		if ($result->recordCount())
		{
			return $result->fetchObject('\ManiaLiveML\Services\Plugin');
		}
	}

	/**
	 * @return int
	 */
	function countAll($category = null)
	{
		$result = null;
		if ($category !== null)
		{
			$result = $this->db->execute(
				'SELECT COUNT(*) '.
				'FROM Plugins ' .
				'WHERE category=%d',
				$category);
		}
		else
		{
			$result = $this->db->execute(
				'SELECT COUNT(*) '.
				'FROM Plugins');
		}
		$row = $result->fetchRow();
		return $row[0];
	}
	
	/**
	 * @return array[\ManiaLiveML\Services\Plugin] 
	 */
	function getList($offset, $length, $category = null)
	{
		$limit = \ManiaLib\Database\Tools::getLimitString((int)$offset, (int)$length);
		$plugins = array();
		
		if ($category !== null)
		{
			$result = $this->db->execute(
				'SELECT * '.
				'FROM Plugins '.
				'WHERE category=%d '.
				'ORDER BY name ASC, version DESC %s',
				$category,
				$limit);
		}
		else 
		{
			$result = $this->db->execute(
				'SELECT * '.
				'FROM Plugins '.
				'ORDER BY name ASC, version DESC %s',
				$limit);
		}
		
		while ($plugin = $result->fetchObject('\ManiaLiveML\Services\Plugin'))
		{
			$plugins[] = $plugin;
		}
		
		return $plugins;
	}
	
	function create(Plugin $plugin)
	{
		$values = array(
			$this->db->quote($plugin->author),
			$this->db->quote($plugin->name),
			$this->db->quote($plugin->version),
			$this->db->quote($plugin->description),
			$this->db->quote($plugin->addressMore),
			$this->db->quote($plugin->category),
			$this->db->quote($plugin->address),
		);
		
		$result = $this->db->execute(
			'INSERT IGNORE INTO Plugins '.
			'(author, name, version, description, addressMore, category, address) '. 
			'VALUES '. 
			'('.implode(',', $values).')');
		
		return $this->db->affectedRows();
	}
	
	function delete(Plugin $plugin)
	{
		$result = $this->db->execute('DELETE FROM Plugins WHERE id=%d', $plugin->id);
		return $this->db->affectedRows();
	}
	
	function update(Plugin $plugin)
	{
		$result = $this->db->execute('UPDATE Plugins SET ' .
				'name=%s,' .
				'version=%f,' .
				'address=%s,' .
				'addressMore=%s,' .
				'description=%s,' .
				'category=%d ' .
				'WHERE id=%d',
			$this->db->quote($plugin->name),
			$plugin->version,
			$this->db->quote($plugin->address),
			$this->db->quote($plugin->addressMore),
			$this->db->quote($plugin->description),
			$plugin->category,
			$plugin->id);
			
		return $this->db->affectedRows();
	}
	
	function countSearch($name = '%', $author = '%', $vmin = '0', $vmax = '1000')
	{
		$result = $this->db->execute('SELECT COUNT(*) FROM Plugins '.
							'WHERE name LIKE %s AND '.
							'author LIKE %s AND '.
							'version > %d AND '.
							'version < %d ',
							$this->db->quote($name),
							$this->db->quote($author),
							$vmin,
							$vmax);

		$count = $result->fetchRow();
		
		return $count[0];
	}
	
	function search($offset, $length, $name = '%', $author = '%', $vmin = '0', $vmax = '1000')
	{
		$limit = \ManiaLib\Database\Tools::getLimitString((int)$offset, (int)$length);
		$plugins = array();
		
		$result = $this->db->execute('SELECT * FROM Plugins '.
							'WHERE name LIKE %s AND '.
							'author LIKE %s AND '.
							'version > %d AND '.
							'version < %d '.
							'%s',
							$this->db->quote($name),
							$this->db->quote($author),
							$vmin,
							$vmax,
							$limit);

		while ($plugin = $result->fetchObject('ManiaLiveML\Services\Plugin'))
			$plugins[] = $plugin;
		
		return $plugins;
	}
}

?>