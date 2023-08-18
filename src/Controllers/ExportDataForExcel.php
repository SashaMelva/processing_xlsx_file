<?php

namespace App\Controllers;

use App\Models\AnnouncementsGroupsModel;
use App\Models\AnnouncementsModel;
use App\Models\AnnouncementsStatusModel;
use App\Models\StatisticModel;
use App\Services\DataBase\ConnectionMySQL;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExportDataForExcel
{
    /**
     * @throws \Exception
     */
    public function export(): void
    {
        $rows = (new SimpleExcelReader(EXCEL_FILE_PATH))
            ->fromSheet(1)
            ->useHeaders(
                [
                    'Дата',
                    'Название объявления',
                    'Статус',
                    'ID объявления',
                    'ID группы объявлений',
                    'Показы',
                    'Клики',
                    'Потрачено, ₽',
                    'Охват'
                ])
            ->getRows();

        $connection = (new ConnectionMySQL())->getMysqli();
        $statuesData = (new AnnouncementsStatusModel($connection))->get();
        $announcementsModel = new AnnouncementsModel($connection);
        $announcementsGroupsModel = new AnnouncementsGroupsModel($connection);
        $statisticModel = new StatisticModel($connection);

        $rows->each(function (array $rowProperties) use ($announcementsGroupsModel, $announcementsModel, $statuesData, $statisticModel) {
            $idGroup = (int)$rowProperties['ID группы объявлений'];
            $idAnnouncement = (int)$rowProperties['ID объявления'];

            if (is_null($announcementsGroupsModel->getById($idGroup))) {
                $announcementsGroupsModel->createGroup($idGroup, (string)$idGroup, "");
            }

            foreach ($statuesData as $status) {

                if ($status['name'] == $rowProperties['Статус']) {
                    $rowProperties['Статус'] = (int)$status['id'];
                }
            }

            if (is_null($announcementsModel->getById($idAnnouncement))) {
                $announcementsModel->create(
                    $idAnnouncement,
                    $rowProperties['Название объявления'],
                    1,
                    (int)$rowProperties['Статус'],
                    (int)$rowProperties['ID группы объявлений']
                );
            }

            if (is_null($statisticModel->getByDateAndAnnouncementId($rowProperties['Дата'], $idAnnouncement))) {
                $statisticModel->create(
                    $rowProperties['Дата'],
                    $idAnnouncement,
                    (int)$rowProperties['Показы'],
                    (int)$rowProperties['Клики'],
                    (float)$rowProperties['Потрачено, ₽'],
                    (int)$rowProperties['Охват'],
                );
            }
        });

        header("Location: /result");
        exit();
    }
}