<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload90174e25ae2b5fd1545f46fdbb1e85aa($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'chartdatabuilderv5' => '/data-transformation/ChartDataBuilderV5.class.php',
            'databuilderv5' => '/data-transformation/DataBuilderV5.class.php',
            'graphontrackersv5_burndown_data' => '/data-transformation/GraphOnTrackersV5_Burndown_Data.class.php',
            'graphontrackersv5_burndown_databuilder' => '/data-transformation/GraphOnTrackersV5_Burndown_DataBuilder.class.php',
            'graphontrackersv5_chart' => '/data-access/GraphOnTrackersV5_Chart.class.php',
            'graphontrackersv5_chart_bar' => '/data-access/GraphOnTrackersV5_Chart_Bar.class.php',
            'graphontrackersv5_chart_bardao' => '/data-access/GraphOnTrackersV5_Chart_BarDao.class.php',
            'graphontrackersv5_chart_bardatabuilder' => '/data-transformation/GraphOnTrackersV5_Chart_BarDataBuilder.class.php',
            'graphontrackersv5_chart_burndown' => '/data-access/GraphOnTrackersV5_Chart_Burndown.class.php',
            'graphontrackersv5_chart_burndowndao' => '/data-access/GraphOnTrackersV5_Chart_BurndownDao.class.php',
            'graphontrackersv5_chart_cumulativeflow' => '/data-access/GraphOnTrackersV5_Chart_CumulativeFlow.class.php',
            'graphontrackersv5_chart_cumulativeflowdao' => '/data-access/GraphOnTrackersV5_Chart_CumulativeFlowDao.class.php',
            'graphontrackersv5_chart_gantt' => '/data-access/GraphOnTrackersV5_Chart_Gantt.class.php',
            'graphontrackersv5_chart_ganttdao' => '/data-access/GraphOnTrackersV5_Chart_GanttDao.class.php',
            'graphontrackersv5_chart_ganttdatabuilder' => '/data-transformation/GraphOnTrackersV5_Chart_GanttDataBuilder.class.php',
            'graphontrackersv5_chart_pie' => '/data-access/GraphOnTrackersV5_Chart_Pie.class.php',
            'graphontrackersv5_chart_piedao' => '/data-access/GraphOnTrackersV5_Chart_PieDao.class.php',
            'graphontrackersv5_chart_piedatabuilder' => '/data-transformation/GraphOnTrackersV5_Chart_PieDataBuilder.class.php',
            'graphontrackersv5_chartdao' => '/data-access/GraphOnTrackersV5_ChartDao.class.php',
            'graphontrackersv5_chartfactory' => '/data-access/GraphOnTrackersV5_ChartFactory.class.php',
            'graphontrackersv5_cumulativeflow_databuilder' => '/data-transformation/GraphOnTrackersV5_CumulativeFlow_DataBuilder.class.php',
            'graphontrackersv5_engine' => '/graphic-library/GraphOnTrackersV5_Engine.class.php',
            'graphontrackersv5_engine_bar' => '/graphic-library/GraphOnTrackersV5_Engine_Bar.class.php',
            'graphontrackersv5_engine_burndown' => '/graphic-library/GraphOnTrackersV5_Engine_Burndown.class.php',
            'graphontrackersv5_engine_cumulativeflow' => '/graphic-library/GraphOnTrackersV5_Engine_CumulativeFlow.class.php',
            'graphontrackersv5_engine_gantt' => '/graphic-library/GraphOnTrackersV5_Engine_Gantt.class.php',
            'graphontrackersv5_engine_pie' => '/graphic-library/GraphOnTrackersV5_Engine_Pie.class.php',
            'graphontrackersv5_graphactionspresenter' => '/GraphActionsPresenter.class.php',
            'graphontrackersv5_insessionchartsorter' => '/data-access/GraphOnTrackersV5_InSessionChartSorter.class.php',
            'graphontrackersv5_renderer' => '/GraphOnTrackersV5_Renderer.class.php',
            'graphontrackersv5_widget_chart' => '/GraphOnTrackersV5_Widget_Chart.class.php',
            'graphontrackersv5_widget_mychart' => '/GraphOnTrackersV5_Widget_MyChart.class.php',
            'graphontrackersv5_widget_projectchart' => '/GraphOnTrackersV5_Widget_ProjectChart.class.php',
            'graphontrackersv5plugin' => '/graphontrackersv5Plugin.class.php',
            'graphontrackersv5plugindescriptor' => '/GraphOnTrackersV5PluginDescriptor.class.php',
            'graphontrackersv5plugininfo' => '/GraphOnTrackersV5PluginInfo.class.php',
            'html_element_selectbox_trackerfields_datesv5' => '/common/HTML_Element_Selectbox_TrackerFields_DatesV5.class.php',
            'html_element_selectbox_trackerfields_int_textfieldsv5' => '/common/HTML_Element_Selectbox_TrackerFields_Int_TextFieldsV5.class.php',
            'html_element_selectbox_trackerfields_numericfieldsv5' => '/common/HTML_Element_Selectbox_TrackerFields_NumericFieldsV5.class.php',
            'html_element_selectbox_trackerfields_selectboxesandtextsv5' => '/common/HTML_Element_Selectbox_TrackerFields_SelectboxesAndTextsV5.class.php',
            'html_element_selectbox_trackerfields_selectboxesv5' => '/common/HTML_Element_Selectbox_TrackerFields_SelectboxesV5.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload90174e25ae2b5fd1545f46fdbb1e85aa');
// @codeCoverageIgnoreEnd
