<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class com_rapidsitemapInstallerScript
{
    /**
     * method to run after an install/update/uninstall method
     * @param $type
     * @param $parent
     * @return void
     */
    function postflight($type, $parent)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('extension_id')));
        $query->from($db->quoteName('#__extensions'));
        $query->where($db->quoteName('element')
            . ' = "' . strtolower($parent->get('manifest')->name) . '"'
            . ' AND ' . $db->quoteName('type') . ' = "component"'
        );
        $db->setQuery($query);
        $results = $db->loadObjectList();
        if (!empty($results)) {
            $query = $db->getQuery(true);
            $conditions = array(
                $db->quoteName('component_id') . ' = ' . $results[0]->extension_id,
                $db->quoteName('client_id') . ' = 1',
                $db->quoteName('menutype') . ' = "main"',
                $db->quoteName('type') . ' = "component"'
            );
            $query->delete($db->quoteName('#__menu'));
            $query->where($conditions);
            $db->setQuery($query);
            $db->query();
        }
    }
}
