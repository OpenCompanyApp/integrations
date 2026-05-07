<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** List Drone repository secrets. */
class DroneCiListSecrets extends AbstractDroneCiTool { protected const NAME = 'drone_ci_list_secrets'; protected const DESCRIPTION = 'List secret metadata configured for a Drone repository.'; protected const METHOD = 'listSecrets'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
