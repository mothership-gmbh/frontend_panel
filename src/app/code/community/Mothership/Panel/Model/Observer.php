<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mothership
 * @package   Mothership_Panel
 * @author    Don Bosco van Hoi <vanhoi@mothership.de>
 * @copyright 2015 Mothership GmbH
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.mothership.de/
 */

/**
 * Class Mothership_Panel_Model_Observer
 *
 * @category  Mothership
 * @package   Mothership_Panel
 * @author    Don Bosco van Hoi <vanhoi@mothership.de>
 * @copyright 2015 Mothership GmbH
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.mothership.de/
 */
class Mothership_Panel_Model_Observer extends Varien_Object
{
    /**
     * This method is called within the dispatched controller_action_layout_load_before event.
     * Instead of using the default layout update handle, a custom update handle will be injected
     * into the layout updates.
     *
     * @param Varien_Event_Observer $observer
     *
     * @return void
     */
    public function addHandle(Varien_Event_Observer $observer)
    {
        if (Mage::helper('mothership_panel/data')->isEnabled()) {
            $observer->getEvent()
                      ->getLayout()
                      ->getUpdate()
                      ->addHandle('mothership_panel');
        }
    }
}