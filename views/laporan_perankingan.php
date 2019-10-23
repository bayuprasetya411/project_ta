
<?php

require_once __DIR__ . '/vendor/autoload.php';

$html = '
<html>
    <head>
        <style>

            body {font-family: sans-serif;
                font-size: 10pt;
            }
            p {	margin: 0pt; }
            table.items {
                border: 0.1mm solid #000000;
            }
            td { vertical-align: top; }
            .items td {
                border-left: 0.1mm solid #000000;
                border-right: 0.1mm solid #000000;
                border: 0.1mm solid #000000;
            }
            table thead th { 
                text-align: center;
                height: 40px;
                border: 0.1mm solid #000000;
            }
            p.double {
                border: double;
            }

        </style>
    </head>
<body>

        <div style="text-align: center;">
            <h3>LAPORAN HASIL PERANGKINGAN TEKNISI</h3>
        </div>

        <table width="100%" style="font-size: 10pt; border-collapse: collapse;  border: 0.1mm solid #000000; " cellpadding="1">
            <tr>
                <td width="50%"></td>
            </tr>
        </table>
        <br />
        
        <table width="100%" cellpadding="3" style="font-size: 10pt;">
            <tr>
                <td width="20%">Periode</td>
                <td>: Maret-2019</td>
            </tr>
        </table>
        <br />

        <table class="items" width="100%" style="font-size: 10pt; border-collapse: collapse; " cellpadding="2">
            <thead>
                <tr>
                    <th width="7%">Rank</th>
                    <th width="40%">Nama Teknisi</th>
                    <th width="10%">Presensi</th>
                    <th width="10%">Disiplin</th>
                    <th width="13%">Produktifitas</th>
                    <th width="7%">Gaul</th>
                    <th width="13%">Total Nilai</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td align="center">1</td>
                    <td>I Gusti Agung Bayu Prasetya Dikayana</td>
                    <td align="center">12</td>
                    <td align="center">28</td>
                    <td align="center">19.5</td>
                    <td align="center">0</td>
                    <td align="center">55</td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td>Bayu Prasetya</td>
                    <td align="center">12</td>
                    <td align="center">28</td>
                    <td align="center">19.5</td>
                    <td align="center">0</td>
                    <td align="center">55</td>
                </tr>

                <tr>
                    <td align="center">3</td>
                    <td>Bayu Prasetya</td>
                    <td align="center">12</td>
                    <td align="center">28</td>
                    <td align="center">19.5</td>
                    <td align="center">0</td>
                    <td align="center">55</td>
                </tr>

                <tr>
                    <td align="center">4</td>
                    <td>Bayu Prasetya</td>
                    <td align="center">12</td>
                    <td align="center">28</td>
                    <td align="center">19.5</td>
                    <td align="center">0</td>
                    <td align="center">55</td>
                </tr>

                <tr>
                    <td align="center">5</td>
                    <td>Bayu Prasetya</td>
                    <td align="center">12</td>
                    <td align="center">28</td>
                    <td align="center">19.5</td>
                    <td align="center">0</td>
                    <td align="center">55</td>
                </tr>

            </tbody>
        </table>
        <br />

        <div style="text-align: right; margin-right:30px">
            Mengetahui & Menyetujui
        </div>
        <br />
        <br />
        <br />
        <br />

        <div style="text-align: right; margin-right:45px">
            <u><b>Akhmad Syrifudin</b></u>
        </div>
        <div style="text-align: right; margin-right:10px">
            Manager BGES Service Denpasar
        </div>
        

    </body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 15,
    'margin_bottom' => 20,
    'margin_header' => 15,
    'margin_footer' => 15
]);
$mpdf->WriteHTML($html);
$mpdf->Output();
