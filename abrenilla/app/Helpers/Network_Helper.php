<?php

if (!function_exists('getUserNetworkInfo')) {

    /**
     * Get the IP and MAC address of the client (LAN or localhost)
     *
     * @return array ['ip' => string, 'mac' => string]
     */
    function getUserNetworkInfo(): array
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

        // Default MAC
        $macAddress = 'LOCALHOST';

        // If not localhost, attempt to detect MAC for LAN IPs
        if ($ipAddress !== '127.0.0.1' && $ipAddress !== '::1') {

            if (preg_match('/^(192\.168|10\.|172\.(1[6-9]|2[0-9]|3[0-1]))\./', $ipAddress)) {
                $os = strtoupper(substr(PHP_OS, 0, 3));

                if ($os !== 'WIN') {
                    // Linux / macOS
                    @exec("ping -c 1 $ipAddress"); // populate ARP
                    $arpOutput = [];
                    @exec("arp -n $ipAddress", $arpOutput);
                    foreach ($arpOutput as $line) {
                        if (preg_match('/([0-9a-f]{2}[:-]){5}[0-9a-f]{2}/i', $line, $matches)) {
                            $macAddress = strtoupper(str_replace('-', ':', $matches[0]));
                            break;
                        }
                    }
                } else {
                    // Windows
                    @exec("ping -n 1 $ipAddress"); // populate ARP
                    $arpOutput = [];
                    @exec("arp -a $ipAddress", $arpOutput);
                    foreach ($arpOutput as $line) {
                        if (preg_match('/([0-9A-F]{2}[:-]){5}[0-9A-F]{2}/i', $line, $matches)) {
                            $macAddress = strtoupper(str_replace('-', ':', $matches[0]));
                            break;
                        }
                    }
                }

                if (!$macAddress) {
                    $macAddress = 'C4:BD:E5:7E:A2:7F';
                }
            } else {
                $macAddress = 'LOCALHOST';
            }
        }

        return [
            'ip'  => $ipAddress,
            'mac' => $macAddress
        ];
    }
}
