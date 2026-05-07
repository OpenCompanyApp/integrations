<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get Drone repository secret metadata. */
class DroneCiGetSecret extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_secret'; protected const DESCRIPTION = 'Get one Drone repository secret by name. Returns metadata only; secret values may not be returned by Drone.'; protected const METHOD = 'getSecret'; protected const REQUIRED = ['owner', 'repo', 'name']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Secret name.']]; }
