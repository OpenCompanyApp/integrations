<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Delete a Drone repository secret. */
class DroneCiDeleteSecret extends AbstractDroneCiTool { protected const NAME = 'drone_ci_delete_secret'; protected const DESCRIPTION = 'Delete one Drone repository secret.'; protected const METHOD = 'deleteSecret'; protected const REQUIRED = ['owner', 'repo', 'name']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Secret name.']]; }
