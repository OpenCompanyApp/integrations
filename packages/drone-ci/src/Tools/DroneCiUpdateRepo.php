<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Update Drone repository settings. */
class DroneCiUpdateRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_update_repo'; protected const DESCRIPTION = 'Update Drone repository settings.'; protected const METHOD = 'updateRepo'; protected const REQUIRED = ['owner', 'repo', 'payload']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Repository settings payload.']]; }
