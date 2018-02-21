<?php
/**
 * Cacher Module
 *
 * @package modules
 * @subpackage cacher
 * @category Third Party Xaraya Module
 * @version 1.0.0
 * @copyright (C) 2014 Luetolf-Carroll GmbH
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @author Marc Lutolf <marc@luetolf-carroll.com>
 */
/**
 * View items of the cacher object
 *
 */
function cacher_admin_view($args)
{
    if (!xarSecurityCheck('ManageCacher')) return;

    $modulename = 'cacher';

    // Define which object will be shown
    if (!xarVarFetch('objectname', 'str', $objectname, null, XARVAR_DONT_SET)) return;
    if (!empty($objectname)) xarModUserVars::set($modulename,'defaultmastertable', $objectname);

    // Set a return url
    xarSession::setVar('ddcontext.' . $modulename, array('return_url' => xarServer::getCurrentURL()));

    // Get the available dropdown options
    $object = DataObjectMaster::getObjectList(array('objectid' => 1));
    $data['objectname'] = xarModUserVars::get($modulename,'defaultmastertable');
    $items = $object->getItems();
    $options = array();
    foreach ($items as $item)
        if (strpos($item['name'],$modulename) !== false)
            $options[] = array('id' => $item['name'], 'name' => $item['name']);
    $data['options'] = $options;
    return $data;
}
?>