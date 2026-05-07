<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Abort one Bitrise app build. */
class BitriseAbortBuild extends AbstractBitriseTool { protected const NAME = 'bitrise_abort_build'; protected const DESCRIPTION = 'Abort one Bitrise build, optionally passing abort_reason, abort_with_success, or skip_notifications.'; protected const METHOD = 'abortBuild'; protected const ARGUMENTS = ['app_slug', 'build_slug']; protected const USE_PAYLOAD = true; }
