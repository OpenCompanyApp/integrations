<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Navigate through components based on the chosen strategy with specified measures. The baseComponentId or the component parameter must be provided. Requires the following permission: 'Browse' on the specified project. When limiting search with the q parameter, directories are not returned..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/measures/component_tree.
 */
class SonarCloudMeasuresComponentTree extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_measures_component_tree';
    protected const DESCRIPTION = 'Navigate through components based on the chosen strategy with specified measures. The baseComponentId or the component parameter must be provided. Requires the following permission: \'Browse\' on the specified project. When limiting search with the q parameter, directories are not returned.

Official SonarCloud Web API endpoint: GET /api/measures/component_tree.';
    protected const PARAMETERS = array (
      'additional_fields' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of additional fields that can be returned in the response.',
        'required' => false,
        'enum' => array (
          'metrics',
          'periods',
        ),
      ),
      'asc' => array (
        'type' => 'string',
        'description' => 'Ascending sort',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'base_component_id' => array (
        'type' => 'string',
        'description' => 'Base component id. The search is based on this component.',
        'required' => false,
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key. The search is based on this component.',
        'required' => false,
      ),
      'developer_id' => array (
        'type' => 'string',
        'description' => 'Deprecated parameter, used previously with the Developer Cockpit plugin. No measures are returned if parameter is set.',
        'required' => false,
      ),
      'developer_key' => array (
        'type' => 'string',
        'description' => 'Deprecated parameter, used previously with the Developer Cockpit plugin. No measures are returned if parameter is set.',
        'required' => false,
      ),
      'metric_keys' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of metric keys. Types DATA, DISTRIB are not allowed.',
        'required' => true,
      ),
      'metric_period_sort' => array (
        'type' => 'string',
        'description' => 'Sort measures by leak period or not ?. The \'s\' parameter must contain the \'metricPeriod\' value.',
        'required' => false,
        'enum' => array (
          '1',
        ),
      ),
      'metric_sort' => array (
        'type' => 'string',
        'description' => 'Metric key to sort by. The \'s\' parameter must contain the \'metric\' or \'metricPeriod\' value. It must be part of the \'metricKeys\' parameter',
        'required' => false,
      ),
      'metric_sort_filter' => array (
        'type' => 'string',
        'description' => 'Filter components. Sort must be on a metric. Possible values are: - all: return all components; - withMeasuresOnly: filter out components that do not have a measure on the sorted metric;',
        'required' => false,
        'enum' => array (
          'all',
          'withMeasuresOnly',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string;',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers. Possible values are:- BRC - Sub-projects; - DIR - Directories; - FIL - Files; - TRK - Projects; - UTS - Test Files;',
        'required' => false,
        'enum' => array (
          'BRC',
          'DIR',
          'FIL',
          'TRK',
          'UTS',
        ),
      ),
      's' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of sort fields',
        'required' => false,
        'enum' => array (
          'metric',
          'metricPeriod',
          'name',
          'path',
          'qualifier',
        ),
      ),
      'strategy' => array (
        'type' => 'string',
        'description' => 'Strategy to search for base component descendants:- children: return the children components of the base component. Grandchildren components are not returned; - all: return all the descendants components of the base component. Grandchildren are returned.; - leaves: return all the descendant components (files, in general) which don\'t have other children. They are the leaves of the component tree.;',
        'required' => false,
        'enum' => array (
          'leaves',
          'all',
          'children',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/measures/component_tree';
    protected const PARAM_MAP = array (
      'additionalFields' => 'additional_fields',
      'asc' => 'asc',
      'baseComponentId' => 'base_component_id',
      'branch' => 'branch',
      'component' => 'component',
      'developerId' => 'developer_id',
      'developerKey' => 'developer_key',
      'metricKeys' => 'metric_keys',
      'metricPeriodSort' => 'metric_period_sort',
      'metricSort' => 'metric_sort',
      'metricSortFilter' => 'metric_sort_filter',
      'p' => 'p',
      'ps' => 'ps',
      'pullRequest' => 'pull_request',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
      's' => 's',
      'strategy' => 'strategy',
    );
}
