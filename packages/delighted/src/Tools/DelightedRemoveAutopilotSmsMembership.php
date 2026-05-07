<?php
namespace OpenCompany\Integrations\Delighted\Tools;
/** Remove a person from SMS Autopilot. */
class DelightedRemoveAutopilotSmsMembership extends AbstractDelightedTool { protected const NAME = 'delighted_remove_autopilot_sms_membership'; protected const DESCRIPTION = 'Remove a person from Delighted SMS Autopilot.'; protected const OPERATION = 'remove_autopilot_sms_membership'; protected const REQUIRED = ['person']; }
