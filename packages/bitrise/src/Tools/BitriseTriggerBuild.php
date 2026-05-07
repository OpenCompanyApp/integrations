<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Trigger a new Bitrise app build. */
class BitriseTriggerBuild extends AbstractBitriseTool { protected const NAME = 'bitrise_trigger_build'; protected const DESCRIPTION = 'Trigger a new build for a Bitrise app using hook_info and build_params.'; protected const METHOD = 'triggerBuild'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
