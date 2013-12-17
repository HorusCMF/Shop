<?php

namespace Horus\SiteBundle\Controller;


use SaadTazi\GChartBundle\DataTable;
use SaadTazi\GChartBundle\Chart\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class LayoutController
 * @package Horus\SiteBundle\Controller
 */
class ChartController extends Controller
{

    public function mainAction()
    {
        /*
         * dataTable for Pie Chart for example (long way - 2 columns)
         */
        $dataTable1 = new DataTable\DataTable(
            array(
                'cols' =>
                array(
                    array(
                        'id'    => 'id1',
                        'label' => 'label1',
                        'type'     => 'string'
                    ),
                    array(
                        'id'    => 'id2',
                        'label' => 'label2',
                        'type'  => 'number'
                    )
                ),
                'rows' =>
                array(
                    //row 1
                    array(
                        array(
                            'v' => 'auto'
                        ),
                        array(
                            'v' => 10,
                            'f' => '10 per hours'
                        )
                    ),
                    array(
                        array(
                            'v' => 'auto row 2'
                        ),
                        array(
                            'v' => 5,
                            'f' => '5 per hours'
                        )
                    )
                )
            )
        );

        /*
         * dataTable for Bar Chart for example (3 columns)
         */
        $dataTable2 = new DataTable\DataTable();
        $dataTable2->addColumn('id1', 'label 1', 'string');
        $dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'label 2', 'number'));
        $dataTable2->addColumnObject(new DataTable\DataColumn('id3', 'label 3', 'number'));

        //test cells as array
        $dataTable2->addRow(array(
            array('v' => 'row 1'),
            array('v' => 2, 'f' => '2 trucks'),
            array('v' => 4, 'f' => '4 bikes')
        ));
        //simple cell (not an array)
        $dataTable2->addRow(array('row 2', 5, 1));
        //mixed
        $dataTable2->addRow(array('row 3', array('v' => 5), 10));
        $dataTable2->addRow(array('row 4', array('v' => 2), 0));
        $dataTable2->addRow(array('row 5', array('v' => 0), 10));
        $dataTable2->addRow(array('row 5', 10, 0));
        $dataTable2->addRow(array('row 5', 4, 5));


        $myArray[0]['idMonth'] = 'January';
        $myArray[0]['idOne'] = 1;
        $myArray[0]['idTwo'] = 2;
        $myArray[1]['idMonth'] = 'February';
        $myArray[1]['idThree'] = 33;
        $myArray[2]['idMonth'] = 'March';
        $myArray[2]['idTwo'] = 2;
        $myArray[2]['idOne'] = 1;
        $myArray[2]['idThree'] = 33;

        //------------
        $dt = new DataTable\DataTable();
        $dt->addColumn('idMonth', 'Months', 'string');
        $dt->addColumn('idOne', 'One', 'number');
        $dt->addColumn('idTwo', 'Two', 'number');
        $dt->addColumn('idThree', 'Three', 'number');
        //------------
        $dt->addRows($myArray);

        // for treemap: requires 4 cols
        $dt10 = new DataTable\DataTable();
        $dt10->addColumn('region', 'Region', 'string');
        $dt10->addColumn('parent', 'Parent', 'string');
        $dt10->addColumn('nb1', 'Number 1 (size)', 'number');
        $dt10->addColumn('nb2', 'Number 2 (color - optional)', 'number');

        $dt10->addRow(array("Global",null,0,0));
        $dt10->addRow(array("America","Global",0,0));
        $dt10->addRow(array("Europe","Global",0,0));
        $dt10->addRow(array("Asia","Global",0,0));
        $dt10->addRow(array("Australia","Global",0,0));
        $dt10->addRow(array("Africa","Global",0,0));
        $dt10->addRow(array("Brazil","America",11,10));
        $dt10->addRow(array("USA","America",52,31));
        $dt10->addRow(array("Mexico","America",24,12));
        $dt10->addRow(array("Canada","America",16,-23));
        $dt10->addRow(array("France","Europe",42,-11));
        $dt10->addRow(array("Germany","Europe",31,-2));
        $dt10->addRow(array("Sweden","Europe",22,-13));
        $dt10->addRow(array("Italy","Europe",17,4));
        $dt10->addRow(array("UK","Europe",21,-5));
        $dt10->addRow(array("China","Asia",36,4));
        $dt10->addRow(array("Japan","Asia",20,-12));
        $dt10->addRow(array("India","Asia",40,63));
        $dt10->addRow(array("Laos","Asia",4,34));
        $dt10->addRow(array("Mongolia","Asia",1,-5));
        $dt10->addRow(array("Israel","Asia",12,24));
        $dt10->addRow(array("Iran","Asia",18,13));
        $dt10->addRow(array("Pakistan","Asia",11,-52));
        $dt10->addRow(array("Egypt","Africa",21,0));
        $dt10->addRow(array("S. Africa","Africa",30,43));
        $dt10->addRow(array("Sudan","Africa",12,2));
        $dt10->addRow(array("Congo","Africa",10,12));
        $dt10->addRow(array("Zair","Africa",10,12));



        return $this->render('HorusSiteBundle:Chart:month.html.twig', array(
            'dt' => $dt->toStrictArray(),
            'dt10'        => $dt10->toArray(),
            'dataTable1' => $dataTable1->toArray()
        ));

    }

    public function monthsAction()
    {

        /*
         * dataTable for Bar Chart for example (3 columns)
         */
        $dataTable2 = new DataTable\DataTable();
        $dataTable2->addColumn('id1', 'label 1', 'string');
        $dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'label 2', 'number'));
        $dataTable2->addColumnObject(new DataTable\DataColumn('id3', 'label 3', 'number'));

        //test cells as array
        $dataTable2->addRow(array(
            array('v' => 'row 1'),
            array('v' => 2, 'f' => '2 trucks'),
            array('v' => 4, 'f' => '4 bikes')
        ));
        //simple cell (not an array)
        $dataTable2->addRow(array('row 2', 5, 1));
        //mixed
        $dataTable2->addRow(array('row 3', array('v' => 5), 10));
        $dataTable2->addRow(array('row 4', array('v' => 2), 0));
        $dataTable2->addRow(array('row 5', array('v' => 0), 10));
        $dataTable2->addRow(array('row 5', 10, 0));
        $dataTable2->addRow(array('row 5', 4, 5));


        $myArray[0]['idMonth'] = 'January';
        $myArray[0]['idOne'] = 1;
        $myArray[0]['idTwo'] = 2;
        $myArray[1]['idMonth'] = 'February';
        $myArray[1]['idThree'] = 33;
        $myArray[2]['idMonth'] = 'March';
        $myArray[2]['idTwo'] = 2;
        $myArray[2]['idOne'] = 1;
        $myArray[2]['idThree'] = 33;

        //------------
        $dt = new DataTable\DataTable();
        $dt->addColumn('idMonth', 'Months', 'string');
        $dt->addColumn('idOne', 'One', 'number');
        $dt->addColumn('idTwo', 'Two', 'number');
        $dt->addColumn('idThree', 'Three', 'number');
        //------------
        $dt->addRows($myArray);

        // for treemap: requires 4 cols
        $dt10 = new DataTable\DataTable();
        $dt10->addColumn('region', 'Region', 'string');
        $dt10->addColumn('parent', 'Parent', 'string');
        $dt10->addColumn('nb1', 'Number 1 (size)', 'number');
        $dt10->addColumn('nb2', 'Number 2 (color - optional)', 'number');

        $dt10->addRow(array("Global",null,0,0));
        $dt10->addRow(array("America","Global",0,0));
        $dt10->addRow(array("Europe","Global",0,0));
        $dt10->addRow(array("Asia","Global",0,0));
        $dt10->addRow(array("Australia","Global",0,0));
        $dt10->addRow(array("Africa","Global",0,0));
        $dt10->addRow(array("Brazil","America",11,10));
        $dt10->addRow(array("USA","America",52,31));
        $dt10->addRow(array("Mexico","America",24,12));
        $dt10->addRow(array("Canada","America",16,-23));
        $dt10->addRow(array("France","Europe",42,-11));
        $dt10->addRow(array("Germany","Europe",31,-2));
        $dt10->addRow(array("Sweden","Europe",22,-13));
        $dt10->addRow(array("Italy","Europe",17,4));
        $dt10->addRow(array("UK","Europe",21,-5));
        $dt10->addRow(array("China","Asia",36,4));
        $dt10->addRow(array("Japan","Asia",20,-12));
        $dt10->addRow(array("India","Asia",40,63));
        $dt10->addRow(array("Laos","Asia",4,34));
        $dt10->addRow(array("Mongolia","Asia",1,-5));
        $dt10->addRow(array("Israel","Asia",12,24));
        $dt10->addRow(array("Iran","Asia",18,13));
        $dt10->addRow(array("Pakistan","Asia",11,-52));
        $dt10->addRow(array("Egypt","Africa",21,0));
        $dt10->addRow(array("S. Africa","Africa",30,43));
        $dt10->addRow(array("Sudan","Africa",12,2));
        $dt10->addRow(array("Congo","Africa",10,12));
        $dt10->addRow(array("Zair","Africa",10,12));

        return $this->render('HorusSiteBundle:Chart:month.html.twig', array(
            'dt' => $dt->toStrictArray(),
            'dt10'        => $dt10->toArray()
        ));
    }

    public function daysAction()
    {

        return $this->render('HorusSiteBundle:Chart:days.html.twig', array(
        ));
    }

}
