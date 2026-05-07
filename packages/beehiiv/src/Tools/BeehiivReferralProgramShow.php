<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get referral program OAuth Scope: referral_program:read.
 *
 * Executes the official beehiiv API operation referralProgram_show.
 */
class BeehiivReferralProgramShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_referral_program_show';
}
