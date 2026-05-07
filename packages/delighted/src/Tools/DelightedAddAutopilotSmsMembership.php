<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Add a person to SMS Autopilot. */
class DelightedAddAutopilotSmsMembership extends AbstractDelightedTool { protected const NAME = 'delighted_add_autopilot_sms_membership'; protected const DESCRIPTION = 'Add a person to Delighted SMS Autopilot.'; protected const OPERATION = 'add_autopilot_sms_membership'; protected const REQUIRED = ['person']; }
