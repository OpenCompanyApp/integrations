<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Change the status of a Security Hotpot. Requires the 'Administer Security Hotspot' permission..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/hotspots/change_status.
 */
class SonarCloudHotspotsChangeStatus extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_hotspots_change_status';
    protected const DESCRIPTION = 'Change the status of a Security Hotpot. Requires the \'Administer Security Hotspot\' permission.

Official SonarCloud Web API endpoint: POST /api/hotspots/change_status.';
    protected const PARAMETERS = array (
      'comment' => array (
        'type' => 'string',
        'description' => 'Comment text.',
        'required' => false,
      ),
      'hotspot' => array (
        'type' => 'string',
        'description' => 'Key of the Security Hotspot',
        'required' => true,
      ),
      'resolution' => array (
        'type' => 'string',
        'description' => 'Resolution of the Security Hotspot when new status is REVIEWED, otherwise must not be set.',
        'required' => false,
        'enum' => array (
          'FIXED',
          'SAFE',
        ),
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'New status of the Security Hotspot.',
        'required' => true,
        'enum' => array (
          'TO_REVIEW',
          'REVIEWED',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/hotspots/change_status';
    protected const PARAM_MAP = array (
      'comment' => 'comment',
      'hotspot' => 'hotspot',
      'resolution' => 'resolution',
      'status' => 'status',
    );
}
