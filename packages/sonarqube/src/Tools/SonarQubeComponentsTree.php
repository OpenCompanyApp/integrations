<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Navigate through components based on the chosen strategy. Requires the following permission: 'Browse' on the specified project. When limiting search with the q parameter, directories are not returned..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/components/tree.
 */
class SonarQubeComponentsTree extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_components_tree';
    protected const DESCRIPTION = 'Navigate through components based on the chosen strategy. Requires the following permission: \'Browse\' on the specified project. When limiting search with the q parameter, directories are not returned.

Official SonarQube Web API endpoint: GET /api/components/tree.';
    protected const PARAMETERS = array (
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
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. Not available in the community edition.',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Base component key. The search is based on this component.',
        'required' => true,
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
        'description' => 'Pull request id. Not available in the community edition.',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string;',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers. Possible values are:- APP - Applications; - VW - Portfolios; - SVW - Portfolios; - UTS - Test Files; - FIL - Files; - DIR - Directories; - TRK - Projects;',
        'required' => false,
        'enum' => array (
          'APP',
          'VW',
          'SVW',
          'UTS',
          'FIL',
          'DIR',
          'TRK',
        ),
      ),
      's' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of sort fields',
        'required' => false,
        'enum' => array (
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
          'all',
          'children',
          'leaves',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/components/tree';
    protected const PARAM_MAP = array (
      'asc' => 'asc',
      'branch' => 'branch',
      'component' => 'component',
      'p' => 'p',
      'ps' => 'ps',
      'pullRequest' => 'pull_request',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
      's' => 's',
      'strategy' => 'strategy',
    );
}
