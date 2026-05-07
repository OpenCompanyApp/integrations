<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CompaniesHouse\CompaniesHouseService;

/**
 * Shared executor for endpoint-specific Companies House tools.
 *
 * Child classes define the mapped service method, parameter schema, and
 * required arguments while this class handles validation and error conversion.
 */
abstract class AbstractCompaniesHouseTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];
    protected const QUERY_KEYS = [];

    /**
     * @param  CompaniesHouseService  $service  Companies House API client.
     */
    public function __construct(protected CompaniesHouseService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the Companies House operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        $query = $this->query($args);

        return match (static::METHOD) {
            'searchAll' => $this->service->searchAll($query),
            'searchCompanies' => $this->service->searchCompanies($query),
            'advancedSearchCompanies' => $this->service->advancedSearchCompanies($query),
            'searchOfficers' => $this->service->searchOfficers($query),
            'searchDisqualifiedOfficers' => $this->service->searchDisqualifiedOfficers($query),
            'companyProfile' => $this->service->companyProfile((string) $args['company_number']),
            'registeredOfficeAddress' => $this->service->registeredOfficeAddress((string) $args['company_number']),
            'officers' => $this->service->officers((string) $args['company_number'], $query),
            'officerAppointment' => $this->service->officerAppointment((string) $args['company_number'], (string) $args['appointment_id']),
            'officerAppointments' => $this->service->officerAppointments((string) $args['officer_id'], $query),
            'registers' => $this->service->registers((string) $args['company_number']),
            'filingHistory' => $this->service->filingHistory((string) $args['company_number'], $query),
            'filingHistoryItem' => $this->service->filingHistoryItem((string) $args['company_number'], (string) $args['transaction_id']),
            'charges' => $this->service->charges((string) $args['company_number'], $query),
            'charge' => $this->service->charge((string) $args['company_number'], (string) $args['charge_id']),
            'insolvency' => $this->service->insolvency((string) $args['company_number']),
            'exemptions' => $this->service->exemptions((string) $args['company_number']),
            'ukEstablishments' => $this->service->ukEstablishments((string) $args['company_number']),
            'pscList' => $this->service->pscList((string) $args['company_number'], $query),
            'pscStatements' => $this->service->pscStatements((string) $args['company_number'], $query),
            'pscIndividual' => $this->service->pscIndividual((string) $args['company_number'], (string) $args['psc_id']),
            'pscCorporateEntity' => $this->service->pscCorporateEntity((string) $args['company_number'], (string) $args['psc_id']),
            'pscLegalPerson' => $this->service->pscLegalPerson((string) $args['company_number'], (string) $args['psc_id']),
            'pscSuperSecure' => $this->service->pscSuperSecure((string) $args['company_number'], (string) $args['psc_id']),
            'pscIndividualBeneficialOwner' => $this->service->pscIndividualBeneficialOwner((string) $args['company_number'], (string) $args['psc_id']),
            'pscCorporateEntityBeneficialOwner' => $this->service->pscCorporateEntityBeneficialOwner((string) $args['company_number'], (string) $args['psc_id']),
            'pscLegalPersonBeneficialOwner' => $this->service->pscLegalPersonBeneficialOwner((string) $args['company_number'], (string) $args['psc_id']),
            'pscSuperSecureBeneficialOwner' => $this->service->pscSuperSecureBeneficialOwner((string) $args['company_number'], (string) $args['psc_id']),
            'pscStatement' => $this->service->pscStatement((string) $args['company_number'], (string) $args['statement_id']),
            'disqualifiedOfficerNatural' => $this->service->disqualifiedOfficerNatural((string) $args['officer_id']),
            'disqualifiedOfficerCorporate' => $this->service->disqualifiedOfficerCorporate((string) $args['officer_id']),
            default => throw new InvalidArgumentException('Unsupported Companies House operation.'),
        };
    }

    /**
     * Build query parameters from allowed top-level arguments and query overrides.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
        foreach (static::QUERY_KEYS as $key) {
            if (array_key_exists($key, $args)) {
                $query[$key] = $args[$key];
            }
        }

        return $query;
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
