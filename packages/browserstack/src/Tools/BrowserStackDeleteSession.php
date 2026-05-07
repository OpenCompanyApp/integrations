<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Delete one BrowserStack Automate session. */
class BrowserStackDeleteSession extends AbstractBrowserStackTool { protected const NAME = 'browserstack_delete_session'; protected const DESCRIPTION = 'Delete one BrowserStack Automate session.'; protected const METHOD = 'deleteSession'; protected const ARGUMENTS = ['session_id']; }
