<?php
namespace Config\Task\Block\Adminhtml;

use Magento\Framework\View\Element\Template;

/**
 *
 */
class Index extends Template
{
    /**
     * @return mixed
     */
    public function getConfigDump()
    {
        // Read the configuration dump from config.php
        $configDump = include BP . '/app/etc/config.php';
        return $configDump;
    }

    /**
     * @return array
     */
    public function getConfigArray()
    {
        $configDump = $this->getConfigDump();
        return is_array($configDump) ? $configDump : [];
    }

    /**
     * @param $configArray
     * @param $parentKey
     * @param $separator
     * @return array
     */
    public function flattenConfigArray($configArray, $parentKey = '', $separator = '/ ')
    {
        $result = [];
        foreach ($configArray as $key => $value) {
            $newKey = empty($parentKey) ? $key : $parentKey . $separator . $key;
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenConfigArray($value, $newKey, $separator));
            } elseif (in_array($value, ['0', '1'])) {
                // Extract the initial key (the first part before $separator)
                $initialKey = explode($separator, $newKey)[0];

                // Skip rows with 'module' in the parent key
                if (($initialKey !== 'modules')&&($initialKey !== 'scopes')&&($initialKey !== 'themes')) {
                    // Split the $newKey into parts using the separator
                    $keyParts = explode($separator, $newKey);

                    // Remove the first two parts (system and default)
                    $keyParts = array_slice($keyParts, 2);

                    // Rejoin the remaining parts to form the modified key
                    $newKey = implode($separator, $keyParts);

                    $result[] = [
                        'parent_key' => $initialKey,
                        'key' => $newKey,
                        'value' => $value,
                    ];
                }
            }
        }
        return $result;
    }

}
