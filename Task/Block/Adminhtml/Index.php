<?php
namespace Config\Task\Block\Adminhtml;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    /**
     * @return mixed
     */
    public function getConfigDump()
    {
        $configFilePath = BP . '/app/etc/config.php';

        // Check if the config.php file exists
        if (file_exists($configFilePath)) {
            $configContents = file_get_contents($configFilePath);
            return $this->parseConfigFile($configContents);
        }

        return [];
    }

    /**
     * @param string $configContents
     * @return array
     */
    private function parseConfigFile($configContents)
    {
        $configArray = [];

        // Use regular expressions to extract the configuration data
        if (preg_match('/return\s+(.*?);/s', $configContents, $matches)) {
            $configArray = eval('return ' . $matches[1] . ';');
        }

        return is_array($configArray) ? $configArray : [];
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
                $initialKey = explode($separator, $newKey)[0];

                if (($initialKey !== 'modules') && ($initialKey !== 'scopes') && ($initialKey !== 'themes')) {
                    $keyParts = explode($separator, $newKey);
                    $keyParts = array_slice($keyParts, 2);
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
