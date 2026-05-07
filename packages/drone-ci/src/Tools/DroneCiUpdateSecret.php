<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Update a Drone repository secret. */
class DroneCiUpdateSecret extends AbstractDroneCiTool { protected const NAME = 'drone_ci_update_secret'; protected const DESCRIPTION = 'Update one Drone repository secret.'; protected const METHOD = 'updateSecret'; protected const REQUIRED = ['owner', 'repo', 'name', 'payload']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Secret name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Secret update payload.']]; }
