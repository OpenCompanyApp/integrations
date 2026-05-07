<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Update Bitrise app email notification settings. */
class BitriseUpdateEmailNotifications extends AbstractBitriseTool { protected const NAME = 'bitrise_update_email_notifications'; protected const DESCRIPTION = 'Update email notification settings for a Bitrise app.'; protected const METHOD = 'updateEmailNotifications'; protected const ARGUMENTS = ['app_slug']; protected const REQUIRED = ['app_slug', 'payload']; protected const USE_PAYLOAD = true; }
