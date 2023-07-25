<?php

namespace App\Service\ServerInformations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class ServerInformationsProvider implements ServerInformationsProviderInterface
{
    private $disk_free_space;

    private $disk_total_space;

    private $percent_available_space;

    private $bdd_used_space;

    public function __construct(
        private Connection $connection
    )
    {
    }

    public function getAvailableSpace()
    {
        if (null === $this->disk_free_space) {
            $this->disk_free_space = disk_free_space('/');
        }

        return $this->getSymbolByQuantity($this->disk_free_space);
    }

    /**
     * @throws Exception
     */
    public function getDatabaseUsedSpace()
    {
        if (null === $this->bdd_used_space) {
            $stmt = $this->connection->prepare("SHOW TABLE STATUS");
            $resultSet = $stmt->executeQuery();
            $this->bdd_used_space = 0;

            foreach ($resultSet as $row) {
                $this->bdd_used_space += $row["Data_length"] + $row["Index_length"];
            }
        }

        return $this->getSymbolByQuantity($this->bdd_used_space);
    }

    public function getTotalSpace()
    {
        if (null === $this->disk_total_space) {
            $this->disk_total_space = disk_total_space('/');
        }

        return $this->getSymbolByQuantity($this->disk_total_space);
    }

    public function getPercentAvailableSpace()
    {
        if (null === $this->percent_available_space) {

            if (null === $this->disk_free_space) {
                $this->disk_free_space = disk_free_space('/');
            }

            if (null === $this->disk_total_space) {
                $this->disk_total_space = disk_total_space('/');
            }

            $this->percent_available_space = ($this->disk_free_space * 100) / $this->disk_total_space;
        }

        return $this->percent_available_space;
    }

    private function getSymbolByQuantity($bytes)
    {
        if ($bytes <= 0) {
            return '0 Octet';
        }

        $symbols = array('Octets', 'Ko', 'Mo', 'Go', 'To', 'Po', 'Eo', 'Zo', 'Yo');
        $exp = floor(log($bytes) / log(1024));

        return number_format($bytes / pow(1024, floor($exp)), 2, ',', ' ') . ' ' . $symbols[$exp];
    }
}