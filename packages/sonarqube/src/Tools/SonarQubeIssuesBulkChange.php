<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Bulk change on issues. Up to 500 issues can be updated. Requires authentication..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/bulk_change.
 */
class SonarQubeIssuesBulkChange extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_bulk_change';
    protected const DESCRIPTION = 'Bulk change on issues. Up to 500 issues can be updated. Requires authentication.

Official SonarQube Web API endpoint: POST /api/issues/bulk_change.';
    protected const PARAMETERS = array (
      'add_tags' => array (
        'type' => 'string',
        'description' => 'Add tags',
        'required' => false,
      ),
      'assign' => array (
        'type' => 'string',
        'description' => 'To assign the list of issues to a specific user (login), or un-assign all the issues',
        'required' => false,
      ),
      'comment' => array (
        'type' => 'string',
        'description' => 'Add a comment. The comment will only be added to issues that are affected either by a change of type or a change of severity as a result of the same WS call.',
        'required' => false,
      ),
      'do_transition' => array (
        'type' => 'string',
        'description' => 'Transition',
        'required' => false,
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
      'issues' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of issue keys',
        'required' => true,
      ),
      'remove_tags' => array (
        'type' => 'string',
        'description' => 'Remove tags',
        'required' => false,
      ),
      'send_notifications' => array (
        'type' => 'string',
        'description' => 'sendNotifications parameter.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'set_severity' => array (
        'type' => 'string',
        'description' => 'To change the severity of the list of issues',
        'required' => false,
        'enum' => array (
          'INFO',
          'MINOR',
          'MAJOR',
          'CRITICAL',
          'BLOCKER',
        ),
      ),
      'set_type' => array (
        'type' => 'string',
        'description' => 'To change the type of the list of issues',
        'required' => false,
        'enum' => array (
          'CODE_SMELL',
          'BUG',
          'VULNERABILITY',
          'SECURITY_HOTSPOT',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/bulk_change';
    protected const PARAM_MAP = array (
      'add_tags' => 'add_tags',
      'assign' => 'assign',
      'comment' => 'comment',
      'do_transition' => 'do_transition',
      'issues' => 'issues',
      'remove_tags' => 'remove_tags',
      'sendNotifications' => 'send_notifications',
      'set_severity' => 'set_severity',
      'set_type' => 'set_type',
    );
}
