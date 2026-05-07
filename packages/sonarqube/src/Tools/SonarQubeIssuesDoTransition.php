<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Do workflow transition on an issue. Requires authentication and Browse permission on project. The transitions 'accept', 'wontfix' and 'falsepositive' require the permission 'Administer Issues'. The transitions involving security hotspots require the permission 'Administer Security Hotspot'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/do_transition.
 */
class SonarQubeIssuesDoTransition extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_do_transition';
    protected const DESCRIPTION = 'Do workflow transition on an issue. Requires authentication and Browse permission on project. The transitions \'accept\', \'wontfix\' and \'falsepositive\' require the permission \'Administer Issues\'. The transitions involving security hotspots require the permission \'Administer Security Hotspot\'.

Official SonarQube Web API endpoint: POST /api/issues/do_transition.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'transition' => array (
        'type' => 'string',
        'description' => 'Transition',
        'required' => true,
        'enum' => array (
          'confirm',
          'unconfirm',
          'reopen',
          'resolve',
          'falsepositive',
          'wontfix',
          'resolveasreviewed',
          'resetastoreview',
          'accept',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/do_transition';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
      'transition' => 'transition',
    );
}
