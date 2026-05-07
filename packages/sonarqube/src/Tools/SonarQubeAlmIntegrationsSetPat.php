<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set a Personal Access Token for the given DevOps Platform setting Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_integrations/set_pat.
 */
class SonarQubeAlmIntegrationsSetPat extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_set_pat';
    protected const DESCRIPTION = 'Set a Personal Access Token for the given DevOps Platform setting Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: POST /api/alm_integrations/set_pat.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform configuration key. This parameter is optional if you have only one single DevOps Platform integration.',
        'required' => false,
      ),
      'pat' => array (
        'type' => 'string',
        'description' => 'Personal Access Token',
        'required' => true,
      ),
      'username' => array (
        'type' => 'string',
        'description' => 'Username',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_integrations/set_pat';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'pat' => 'pat',
      'username' => 'username',
    );
}
