<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Delete an uploaded BrowserStack App Automate app. */
class BrowserStackDeleteApp extends AbstractBrowserStackTool { protected const NAME = 'browserstack_delete_app'; protected const DESCRIPTION = 'Delete one uploaded BrowserStack App Automate app by app id.'; protected const METHOD = 'deleteApp'; protected const ARGUMENTS = ['app_id']; }
