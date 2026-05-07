<?php

namespace OpenCompany\Integrations\Semgrep;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Semgrep.
 *
 * Exposes the official Semgrep Web API OpenAPI operation set as endpoint-specific
 * agent tools and resolves account-specific API tokens in multi-account hosts.
 */
class SemgrepToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */ public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'api_token','legacy_auth_type'=>'api_token','credential_mode'=>'secret','setup_flows'=>['manual_secret'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>[],'notes'=>['Send a Semgrep API token with Web API access enabled using the Bearer authorization scheme.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_secret','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'semgrep'; } public function appMeta(): array { return ['label'=>'Semgrep','description'=>'Deployments, findings, projects, policies, scans, dependencies, SBOM exports, and ticket links','icon'=>'ph:shield-check','logo'=>'simple-icons:semgrep']; }
    public function integrationMeta(): array { return ['name'=>'Semgrep','description'=>'Manage Semgrep AppSec Platform deployments, findings, projects, policies, scans, dependencies, SBOM exports, secrets, and ticketing links.','icon'=>'ph:shield-check','logo'=>'simple-icons:semgrep','category'=>'data','badge'=>'verified','docs_url'=>'https://semgrep.dev/api/v1/docs/']; }
    public function configSchema(): array { return [['key'=>'api_token','type'=>'secret','label'=>'API Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://semgrep.dev','default'=>'https://semgrep.dev']]; }
    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */ public function testConnection(array $config): array { $token=(string)($config['api_token']??''); $baseUrl=rtrim((string)($config['url']??'https://semgrep.dev'),'/'); if($token==='')return ['success'=>false,'error'=>'Semgrep API token is required.']; try{$response=Http::withHeaders(['Authorization'=>'Bearer '.$token,'Accept'=>'application/json','Content-Type'=>'application/json'])->timeout(10)->get($baseUrl.'/api/v1/ping'); if(!$response->successful())return ['success'=>false,'error'=>'Semgrep API returned HTTP '.$response->status().'.']; return ['success'=>true,'message'=>'Connected to Semgrep at '.$baseUrl.'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['api_token'=>'required|string','url'=>'nullable|url']; } public function credentialFields(): array { return [['key'=>'api_token','type'=>'secret','label'=>'API Token','required'=>true],['key'=>'url','type'=>'url','label'=>'API Base URL','required'=>false,'default'=>'https://semgrep.dev']]; }
    public function tools(): array { return [
  'semgrep_misc_service_get_bootstrap_sms_vpc' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepMiscServiceGetBootstrapSmsVpc',
  'type' => 'read',
  'name' => '[Beta] Get SMS VPC Bootstrap CloudFormation Template',
  'description' => '[Beta] Get SMS VPC Bootstrap CloudFormation Template Official Semgrep Web API endpoint: GET /api/v1/bootstrap-sms-vpc VPC support for Managed Scans is in private beta. Returns the Managed Scans VPC Bootstrap CloudFormation template in JSON ',
  'icon' => 'ph:shield-check',
),
  'semgrep_deployments_service_list_deployments' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepDeploymentsServiceListDeployments',
  'type' => 'read',
  'name' => 'List deployments',
  'description' => 'List deployments Official Semgrep Web API endpoint: GET /api/v1/deployments Request the deployments your auth can access. Currently available auth scope does not extend over more than one deployment. This endpoint returns the single deploym',
  'icon' => 'ph:shield-check',
),
  'semgrep_supply_chain_service_list_dependencies' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSupplyChainServiceListDependencies',
  'type' => 'write',
  'name' => 'List dependencies',
  'description' => 'List dependencies Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/dependencies',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_supply_chain_service_list_repositories_for_dependencies' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSupplyChainServiceListRepositoriesForDependencies',
  'type' => 'write',
  'name' => 'List repositories with dependencies',
  'description' => 'List repositories with dependencies Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/dependencies/repositories',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_supply_chain_service_list_lockfiles_for_dependencies' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSupplyChainServiceListLockfilesForDependencies',
  'type' => 'write',
  'name' => 'List lockfiles in a given repository with dependencies',
  'description' => 'List lockfiles in a given repository with dependencies Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/dependencies/repositories/{repositoryId}/lockfiles',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_policies_service_list_policies' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepPoliciesServiceListPolicies',
  'type' => 'read',
  'name' => 'List policies',
  'description' => 'List policies Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/policies',
  'icon' => 'ph:shield-check',
),
  'semgrep_policies_service_list_policy_rules' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepPoliciesServiceListPolicyRules',
  'type' => 'read',
  'name' => 'List policy rules',
  'description' => 'List policy rules Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/policies/{policyId}',
  'icon' => 'ph:shield-check',
),
  'semgrep_policies_service_update_policy' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepPoliciesServiceUpdatePolicy',
  'type' => 'write',
  'name' => 'Update policy',
  'description' => 'Update policy Official Semgrep Web API endpoint: PUT /api/v1/deployments/{deploymentId}/policies/{policyId}',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_supply_chain_service_create_sbom_export' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSupplyChainServiceCreateSbomExport',
  'type' => 'write',
  'name' => 'Create a new SBOM export job',
  'description' => 'Create a new SBOM export job Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/sbom/export',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_supply_chain_service_get_sbom_export' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSupplyChainServiceGetSbomExport',
  'type' => 'read',
  'name' => 'Get the status of a SBOM export job',
  'description' => 'Get the status of a SBOM export job Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/sbom/export/{taskToken}',
  'icon' => 'ph:shield-check',
),
  'semgrep_scans_service_get_scan' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepScansServiceGetScan',
  'type' => 'read',
  'name' => 'Get scan details',
  'description' => 'Get scan details Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/scan/{scanId} Request the details of a scan including the associated deployment, repository, and commit information.',
  'icon' => 'ph:shield-check',
),
  'semgrep_scans_service_search_scans' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepScansServiceSearchScans',
  'type' => 'write',
  'name' => 'List scans (beta)',
  'description' => 'List scans (beta) Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/scans/search List the scans associated with a particular repository over the past 30 days.',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_secrets_service_list_secrets_path' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepSecretsServiceListSecretsPath',
  'type' => 'read',
  'name' => 'List secrets',
  'description' => 'List secrets Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentId}/secrets',
  'icon' => 'ph:shield-check',
),
  'semgrep_ticketing_service_delete_ticket' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepTicketingServiceDeleteTicket',
  'type' => 'write',
  'name' => 'Unlink a Jira ticket',
  'description' => 'Unlink a Jira ticket Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentId}/ticketing/v2/tickets/{externalTicketId} Unlink a Jira ticket by its ID',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_ticketing_service_link_ticket' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepTicketingServiceLinkTicket',
  'type' => 'write',
  'name' => 'Link an existing ticket to findings',
  'description' => 'Link an existing ticket to findings Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/tickets/link Link an existing external ticket (e.g. Jira) to one or more Semgrep findings by providing the ticket URL and a list ',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_ticketing_service_unlink_ticket' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepTicketingServiceUnlinkTicket',
  'type' => 'write',
  'name' => 'Unlink a ticket from findings',
  'description' => 'Unlink a ticket from findings Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/tickets/unlink Remove the ticket association from one or more Semgrep findings by providing a list of finding IDs. This does not delete',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_findings_service_list_findings' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepFindingsServiceListFindings',
  'type' => 'read',
  'name' => 'List code, supply chain, or AI-powered scan findings',
  'description' => 'List code, supply chain, or AI-powered scan findings Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/findings Request the list of code, supply chain, or AI-powered scan findings in an organization, paginated in p',
  'icon' => 'ph:shield-check',
),
  'semgrep_projects_service_list_projects' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceListProjects',
  'type' => 'read',
  'name' => 'List all projects',
  'description' => 'List all projects Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/projects Request the list of projects that have been scanned or onboarded to Managed Scans. Does not return archived repositories. Returns 100 pro',
  'icon' => 'ph:shield-check',
),
  'semgrep_projects_service_get_project' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceGetProject',
  'type' => 'read',
  'name' => 'Get project details',
  'description' => 'Get project details Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/projects/{projectName} Retrieve details for a single project associated with a deployment that you have access to.',
  'icon' => 'ph:shield-check',
),
  'semgrep_projects_service_update_project' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceUpdateProject',
  'type' => 'write',
  'name' => 'Update project details',
  'description' => 'Update project details Official Semgrep Web API endpoint: PATCH /api/v1/deployments/{deploymentSlug}/projects/{projectName} Update attributes for the project using the value passed in to the request body. Note: The only attribute that is su',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_projects_service_delete_project' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceDeleteProject',
  'type' => 'write',
  'name' => 'Delete project',
  'description' => 'Delete project Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentSlug}/projects/{projectName} Delete a project for a deployment you have access to. This will also delete all of the associated findings.',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_projects_service_toggle_project_managed_scan' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceToggleProjectManagedScan',
  'type' => 'write',
  'name' => 'Toggle Managed Scans for a project',
  'description' => 'Toggle Managed Scans for a project Official Semgrep Web API endpoint: PATCH /api/v1/deployments/{deploymentSlug}/projects/{projectName}/managed-scan Enable or disable [Semgrep Managed Scans](/docs/deployment/managed-scanning/overview) for a',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_projects_service_add_project_tags' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceAddProjectTags',
  'type' => 'write',
  'name' => 'Add tags to project',
  'description' => 'Add tags to project Official Semgrep Web API endpoint: PUT /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags Add tags to a project for a deployment you have access to. Any project tags that do not already exist for the deploy',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_projects_service_delete_project_tags' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepProjectsServiceDeleteProjectTags',
  'type' => 'write',
  'name' => 'Remove tags from project',
  'description' => 'Remove tags from project Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags Remove tags from a project for a deployment you have access to. This request will not delete project tags fr',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_ticketing_service_create_ticket' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepTicketingServiceCreateTicket',
  'type' => 'write',
  'name' => 'Create Jira tickets',
  'description' => 'Create Jira tickets Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentSlug}/tickets Create Jira tickets for your findings. You can create tickets by passing in a list of issue_ids or by passing in filter query parameter',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_triage_service_bulk_triage' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepTriageServiceBulkTriage',
  'type' => 'write',
  'name' => 'Bulk triage',
  'description' => 'Bulk triage Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentSlug}/triage Bulk triage your findings. You can select the findings to triage by passing in a list of finding IDs as issue_ids, or by passing in filter query',
  'icon' => 'ph:pencil-simple',
),
  'semgrep_misc_service_ping' => array (
  'class' => 'OpenCompany\\Integrations\\Semgrep\\Tools\\SemgrepMiscServicePing',
  'type' => 'read',
  'name' => 'Ping',
  'description' => 'Ping Official Semgrep Web API endpoint: GET /api/v1/ping Use to ping the server and assert liveness.',
  'icon' => 'ph:shield-check',
),
]; }
    public function isIntegration(): bool { return true; } public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); } public function luaDocsPath(): ?string { return __DIR__.'/../lua-docs/semgrep.md'; }
    /** @param  array<string, mixed>  $context  Optional account context from the host. */ private function resolveService(array $context = []): SemgrepService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new SemgrepService(apiToken:$creds->get('semgrep','api_token','',$account), baseUrl:$creds->get('semgrep','url','https://semgrep.dev',$account));} return app(SemgrepService::class); }
}
