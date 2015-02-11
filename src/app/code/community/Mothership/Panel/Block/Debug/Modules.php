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
 * Class Mothership_Panel_Block_Debug_Modules
 *
 * @category  Mothership
 * @package   Mothership_Panel
 * @author    Don Bosco van Hoi <vanhoi@mothership.de>
 * @copyright 2015 Mothership GmbH
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.mothership.de/
 *
 * Used for debugging purpose. Displays all modules and their versions
 */
class Mothership_Panel_Block_Debug_Modules extends Mage_Core_Block_Template
{
    /**
     * Returns all registered modules as an assoziative array
     *
     * @var array[string]mixed
     */
    protected $_modules = array(
        'local'     => array(),
        'community' => array(),
        'core'      => array()
    );

    /**
     * The logic of this method is heavily influenced by the original authors. All credits goes directly to them.
     *
     * Builds an associative array, which will returns all registered modules
     *
     * @link https://github.com/kiang/magneto-debug/blob/master/app/code/community/Olctw/Debug/Block/Versions.php
     */
    public function getAll()
    {
        $this->_modules['core'][] = array (
            'module'   => 'Magento',
            'codePool' => 'core',
            'active'   => 'true',
            'version'  => Mage::getVersion()
        );

        foreach (Mage::getConfig()->getModuleConfig() as $node) {
            foreach ($node as $module => $data) {
                if (!isset($data->codePool)) {
                    continue;
                }
                $codePool = $data->codePool->asArray();
                if (empty($codePool)) {
                    continue;
                }
                if (is_array($codePool)) {
                    $codePool = implode('.', $codePool);
                }

                $this->_modules[$codePool][] = array (
                    'module'   => $module,
                    'codePool' => $codePool,
                    'active'   => $data->active,
                    'version'  => $data->version
                );
            }
        }

        return $this->_modules;
    }
}