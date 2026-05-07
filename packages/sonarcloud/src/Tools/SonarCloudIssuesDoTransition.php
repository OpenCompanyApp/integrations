<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Do workflow transition on an issue. Requires authentication and Browse permission on project. The transitions 'accept', 'wontfix', and 'falsepositive' require the permission 'Administer Issues'. The transitions involving security hotspots require the permission 'Administer Security Hotspot'..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/do_transition.
 */
class SonarCloudIssuesDoTransition extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_do_transition';
    protected const DESCRIPTION = 'Do workflow transition on an issue. Requires authentication and Browse permission on project. The transitions \'accept\', \'wontfix\', and \'falsepositive\' require the permission \'Administer Issues\'. The transitions involving security hotspots require the permission \'Administer Security Hotspot\'.

Official SonarCloud Web API endpoint: POST /api/issues/do_transition.';
    protected const PARAMETERS = array (
      'comment' => array (
        'type' => 'string',
        'description' => 'Comment text',
        'required' => false,
      ),
      'is_feedback' => array (
        'type' => 'string',
        'description' => 'Define is the given comment is a feedback',
        'required' => false,
      ),
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
          'close',
          'wontfix',
          'accept',
          'resolveasreviewed',
          'resolveassafe',
          'resolveasacknowledged',
          'resetastoreview',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/do_transition';
    protected const PARAM_MAP = array (
      'comment' => 'comment',
      'isFeedback' => 'is_feedback',
      'issue' => 'issue',
      'transition' => 'transition',
    );
}
