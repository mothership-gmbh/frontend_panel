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
 * Class Mothership_Panel_Model_Debugger_Layout_Observer
 *
 * @category  Mothership
 * @package   Mothership_Panel
 * @author    Don Bosco van Hoi <vanhoi@mothership.de>
 * @copyright 2015 Mothership GmbH
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.mothership.de/
 */
class Mothership_Panel_Model_Debugger_Layout_Observer extends Varien_Object
{
    const FLAG_SHOW_LAYOUT 			= 'showLayout';
    const FLAG_SHOW_LAYOUT_FORMAT 	= 'showLayoutFormat';
    const HTTP_HEADER_TEXT			= 'Content-Type: text/plain';
    const HTTP_HEADER_HTML			= 'Content-Type: text/html';
    const HTTP_HEADER_XML			= 'Content-Type: text/xml';

    private $request;

    private function init() {
        $this->setLayout(Mage::app()->getFrontController()->getAction()->getLayout());
        $this->setUpdate($this->getLayout()->getUpdate());
    }

    /**
     * Use the
     *
     * @param Varien_Event_Observer $observer
     *
     * @return void
     */
    public function debugBlocks(Varien_Event_Observer $observer)
    {
        $layout       = $observer->getEvent()->getLayout();
        $layoutBlocks = $layout->getAllBlocks();
        // After layout generates all the blocks
        foreach ($layoutBlocks as $block) {
            $blockStruct                = array ();
            $parentBlock                = $block->getParentBlock();
            $blockStruct['parent']      = isset($parentBlock) ? $parentBlock->getNameInLayout() : "";
            $blockStruct['class']       = get_class($block);
            $blockStruct['layout_name'] = $block->getNameInLayout();
            if (method_exists($block, 'getTemplateFile')) {
                $blockStruct['template'] = $block->getTemplateFile();
            } else {
                $blockStruct['template'] = '';
            }
            if (method_exists($block, 'getViewVars')) {
                $blockStruct['context'] = $block->getViewVars();
            } else {
                $blockStruct['context'] = null;
            }
            Mage::getSingleton('debug/observer')->layoutBlocks[] = $blockStruct;
        }
    }

    //entry point
    /*public function checkForLayoutDisplayRequest($observer) {
        $this->init();
        $is_set = array_key_exists(self::FLAG_SHOW_LAYOUT, $_GET);
        if(		$is_set && 'package' == $_GET[self::FLAG_SHOW_LAYOUT]) {
            $this->outputPackageLayout();
        }
        else if($is_set && 'page'    == $_GET[self::FLAG_SHOW_LAYOUT]) {
            $this->outputPageLayout();
        }
        else if($is_set && 'handles' == $_GET[self::FLAG_SHOW_LAYOUT]) {
            $this->outputHandles();
        }

      //  $layout = $this->getLayout();
      //  $layout->getUpdate()->addHandle('mothership_panel');

    }

    private function outputHandles() {
        $update  = $this->getUpdate();
        $handles = $update->getHandles();
        echo '<h1>','Handles For This Request','</h1>'."\n";
        echo '<ol>' . "\n";
        foreach($handles as $handle) {
            echo '<li>',$handle,'</li>';
        }
        echo '</ol>' . "\n";
        die();
    }

    private function outputHeaders() {
        $is_set = array_key_exists(self::FLAG_SHOW_LAYOUT_FORMAT,$_GET);
        $header		= self::HTTP_HEADER_XML;
        if($is_set && 'text' == $_GET[self::FLAG_SHOW_LAYOUT_FORMAT]) {
            $header = self::HTTP_HEADER_TEXT;
        }
        header($header);
    }

    private function outputPageLayout() {
        $layout = $this->getLayout();

        $blocks = $layout->getAllBlocks();

        foreach ($blocks as $block) {
       //     echo $block->getTemplateFile();
        }


        $this->outputHeaders();


        die($layout->getNode()->asXML());
    }

    private function outputPackageLayout() {
        $update = $this->getUpdate();
        $this->outputHeaders();
        die($update->getPackageLayout()->asXML());
    }*/
}