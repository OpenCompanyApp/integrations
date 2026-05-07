<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Create a Drone repository secret. */
class DroneCiCreateSecret extends AbstractDroneCiTool { protected const NAME = 'drone_ci_create_secret'; protected const DESCRIPTION = 'Create a secret for a Drone repository.'; protected const METHOD = 'createSecret'; protected const REQUIRED = ['owner', 'repo', 'payload']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Secret payload such as name, data, pull_request, and events.']]; }
