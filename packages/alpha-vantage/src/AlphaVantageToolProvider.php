<?php

namespace OpenCompany\Integrations\AlphaVantage;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Alpha Vantage.
 *
 * Exposes the official Alpha Vantage query functions for equities, options,
 * news, fundamentals, FX, crypto, commodities, economics, and technical indicators.
 */
class AlphaVantageToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Requires an Alpha Vantage API key. Free keys are rate limited and some endpoints require premium entitlement.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'alpha-vantage';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Alpha Vantage',
            'description' => 'Stocks, options, news, fundamentals, FX, crypto, commodities, economics, and technical indicators',
            'icon' => 'ph:chart-line',
            'logo' => 'ph:chart-line',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Alpha Vantage',
            'description' => 'Official Alpha Vantage APIs for equities, realtime and historical prices, options, news sentiment, fundamentals, FX, crypto, commodities, economic indicators, and technical indicators.',
            'icon' => 'ph:chart-line',
            'logo' => 'ph:chart-line',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.alphavantage.co/documentation/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Alpha Vantage API key', 'hint' => 'Required for all Alpha Vantage API calls.', 'required' => true],
        ];
    }

    /**
     * Verify Alpha Vantage credentials with the lightweight market status endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::acceptJson()->timeout(20)->get('https://www.alphavantage.co/query', [
                'function' => 'MARKET_STATUS',
                'apikey' => $apiKey,
            ]);
            $json = $response->json();
            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Alpha Vantage API returned HTTP '.$response->status().'.'];
            }
            if (is_array($json) && (isset($json['Error Message']) || isset($json['Note']) || isset($json['Information']))) {
                return ['success' => false, 'error' => (string) ($json['Error Message'] ?? $json['Note'] ?? $json['Information'])];
            }

            return ['success' => true, 'message' => 'Alpha Vantage credentials verified.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Alpha Vantage API key', 'hint' => 'Required for all Alpha Vantage API calls.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'alpha_vantage_ad' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAd', 'type' => 'read', 'name' => 'Ad', 'description' => 'Fetch Alpha Vantage technical indicator data for AD.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_adosc' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAdosc', 'type' => 'read', 'name' => 'Adosc', 'description' => 'Fetch Alpha Vantage technical indicator data for ADOSC.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_adx' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAdx', 'type' => 'read', 'name' => 'Adx', 'description' => 'Fetch Alpha Vantage technical indicator data for ADX.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_adxr' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAdxr', 'type' => 'read', 'name' => 'Adxr', 'description' => 'Fetch Alpha Vantage technical indicator data for ADXR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_all_commodities' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAllCommodities', 'type' => 'read', 'name' => 'All Commodities', 'description' => 'Fetch Alpha Vantage commodity data for ALL_COMMODITIES.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_aluminum' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAluminum', 'type' => 'read', 'name' => 'Aluminum', 'description' => 'Fetch Alpha Vantage commodity data for ALUMINUM.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_analytics_fixed_window' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAnalyticsFixedWindow', 'type' => 'read', 'name' => 'Analytics Fixed Window', 'description' => 'Fetch Alpha Vantage intelligence data for ANALYTICS_FIXED_WINDOW.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_analytics_sliding_window' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAnalyticsSlidingWindow', 'type' => 'read', 'name' => 'Analytics Sliding Window', 'description' => 'Fetch Alpha Vantage intelligence data for ANALYTICS_SLIDING_WINDOW.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_apo' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageApo', 'type' => 'read', 'name' => 'Apo', 'description' => 'Fetch Alpha Vantage technical indicator data for APO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_aroon' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAroon', 'type' => 'read', 'name' => 'Aroon', 'description' => 'Fetch Alpha Vantage technical indicator data for AROON.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_aroonosc' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAroonosc', 'type' => 'read', 'name' => 'Aroonosc', 'description' => 'Fetch Alpha Vantage technical indicator data for AROONOSC.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_atr' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageAtr', 'type' => 'read', 'name' => 'Atr', 'description' => 'Fetch Alpha Vantage technical indicator data for ATR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_balance_sheet' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageBalanceSheet', 'type' => 'read', 'name' => 'Balance Sheet', 'description' => 'Fetch Alpha Vantage company fundamental data for BALANCE_SHEET.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_bbands' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageBbands', 'type' => 'read', 'name' => 'Bbands', 'description' => 'Fetch Alpha Vantage technical indicator data for BBANDS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_bop' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageBop', 'type' => 'read', 'name' => 'Bop', 'description' => 'Fetch Alpha Vantage technical indicator data for BOP.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_brent' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageBrent', 'type' => 'read', 'name' => 'Brent', 'description' => 'Fetch Alpha Vantage commodity data for BRENT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_cash_flow' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCashFlow', 'type' => 'read', 'name' => 'Cash Flow', 'description' => 'Fetch Alpha Vantage company fundamental data for CASH_FLOW.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_cci' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCci', 'type' => 'read', 'name' => 'Cci', 'description' => 'Fetch Alpha Vantage technical indicator data for CCI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_cmo' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCmo', 'type' => 'read', 'name' => 'Cmo', 'description' => 'Fetch Alpha Vantage technical indicator data for CMO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_coffee' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCoffee', 'type' => 'read', 'name' => 'Coffee', 'description' => 'Fetch Alpha Vantage commodity data for COFFEE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_copper' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCopper', 'type' => 'read', 'name' => 'Copper', 'description' => 'Fetch Alpha Vantage commodity data for COPPER.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_corn' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCorn', 'type' => 'read', 'name' => 'Corn', 'description' => 'Fetch Alpha Vantage commodity data for CORN.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_cotton' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCotton', 'type' => 'read', 'name' => 'Cotton', 'description' => 'Fetch Alpha Vantage commodity data for COTTON.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_cpi' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCpi', 'type' => 'read', 'name' => 'Cpi', 'description' => 'Fetch Alpha Vantage economic indicator data for CPI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_crypto_intraday' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCryptoIntraday', 'type' => 'read', 'name' => 'Crypto Intraday', 'description' => 'Fetch Alpha Vantage crypto currency data for CRYPTO_INTRADAY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_currency_exchange_rate' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageCurrencyExchangeRate', 'type' => 'read', 'name' => 'Currency Exchange Rate', 'description' => 'Fetch Alpha Vantage foreign exchange data for CURRENCY_EXCHANGE_RATE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_dema' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDema', 'type' => 'read', 'name' => 'Dema', 'description' => 'Fetch Alpha Vantage technical indicator data for DEMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_digital_currency_daily' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDigitalCurrencyDaily', 'type' => 'read', 'name' => 'Digital Currency Daily', 'description' => 'Fetch Alpha Vantage crypto currency data for DIGITAL_CURRENCY_DAILY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_digital_currency_monthly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDigitalCurrencyMonthly', 'type' => 'read', 'name' => 'Digital Currency Monthly', 'description' => 'Fetch Alpha Vantage crypto currency data for DIGITAL_CURRENCY_MONTHLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_digital_currency_weekly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDigitalCurrencyWeekly', 'type' => 'read', 'name' => 'Digital Currency Weekly', 'description' => 'Fetch Alpha Vantage crypto currency data for DIGITAL_CURRENCY_WEEKLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_dividends' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDividends', 'type' => 'read', 'name' => 'Dividends', 'description' => 'Fetch Alpha Vantage company fundamental data for DIVIDENDS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_durables' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDurables', 'type' => 'read', 'name' => 'Durables', 'description' => 'Fetch Alpha Vantage economic indicator data for DURABLES.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_dx' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageDx', 'type' => 'read', 'name' => 'Dx', 'description' => 'Fetch Alpha Vantage technical indicator data for DX.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_earnings' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEarnings', 'type' => 'read', 'name' => 'Earnings', 'description' => 'Fetch Alpha Vantage company fundamental data for EARNINGS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_earnings_calendar' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEarningsCalendar', 'type' => 'read', 'name' => 'Earnings Calendar', 'description' => 'Fetch Alpha Vantage calendar/listing data for EARNINGS_CALENDAR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_earnings_call_transcript' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEarningsCallTranscript', 'type' => 'read', 'name' => 'Earnings Call Transcript', 'description' => 'Fetch Alpha Vantage intelligence data for EARNINGS_CALL_TRANSCRIPT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_earnings_estimates' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEarningsEstimates', 'type' => 'read', 'name' => 'Earnings Estimates', 'description' => 'Fetch Alpha Vantage company fundamental data for EARNINGS_ESTIMATES.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ema' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEma', 'type' => 'read', 'name' => 'Ema', 'description' => 'Fetch Alpha Vantage technical indicator data for EMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_etf_profile' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageEtfProfile', 'type' => 'read', 'name' => 'Etf Profile', 'description' => 'Fetch Alpha Vantage company fundamental data for ETF_PROFILE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_federal_funds_rate' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageFederalFundsRate', 'type' => 'read', 'name' => 'Federal Funds Rate', 'description' => 'Fetch Alpha Vantage economic indicator data for FEDERAL_FUNDS_RATE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_fx_daily' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageFxDaily', 'type' => 'read', 'name' => 'Fx Daily', 'description' => 'Fetch Alpha Vantage foreign exchange data for FX_DAILY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_fx_intraday' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageFxIntraday', 'type' => 'read', 'name' => 'Fx Intraday', 'description' => 'Fetch Alpha Vantage foreign exchange data for FX_INTRADAY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_fx_monthly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageFxMonthly', 'type' => 'read', 'name' => 'Fx Monthly', 'description' => 'Fetch Alpha Vantage foreign exchange data for FX_MONTHLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_fx_weekly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageFxWeekly', 'type' => 'read', 'name' => 'Fx Weekly', 'description' => 'Fetch Alpha Vantage foreign exchange data for FX_WEEKLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_global_quote' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageGlobalQuote', 'type' => 'read', 'name' => 'Global Quote', 'description' => 'Fetch Alpha Vantage equity market data for GLOBAL_QUOTE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_gold_silver_history' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageGoldSilverHistory', 'type' => 'read', 'name' => 'Gold Silver History', 'description' => 'Fetch Alpha Vantage commodity data for GOLD_SILVER_HISTORY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_gold_silver_spot' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageGoldSilverSpot', 'type' => 'read', 'name' => 'Gold Silver Spot', 'description' => 'Fetch Alpha Vantage commodity data for GOLD_SILVER_SPOT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_historical_options' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHistoricalOptions', 'type' => 'read', 'name' => 'Historical Options', 'description' => 'Fetch Alpha Vantage US options data for HISTORICAL_OPTIONS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_historical_put_call_ratio' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHistoricalPutCallRatio', 'type' => 'read', 'name' => 'Historical Put Call Ratio', 'description' => 'Fetch Alpha Vantage US options data for HISTORICAL_PUT_CALL_RATIO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_historical_volume_open_interest_ratio' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHistoricalVolumeOpenInterestRatio', 'type' => 'read', 'name' => 'Historical Volume Open Interest Ratio', 'description' => 'Fetch Alpha Vantage US options data for HISTORICAL_VOLUME_OPEN_INTEREST_RATIO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_dcperiod' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtDcperiod', 'type' => 'read', 'name' => 'Ht Dcperiod', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_DCPERIOD.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_dcphase' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtDcphase', 'type' => 'read', 'name' => 'Ht Dcphase', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_DCPHASE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_phasor' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtPhasor', 'type' => 'read', 'name' => 'Ht Phasor', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_PHASOR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_sine' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtSine', 'type' => 'read', 'name' => 'Ht Sine', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_SINE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_trendline' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtTrendline', 'type' => 'read', 'name' => 'Ht Trendline', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_TRENDLINE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ht_trendmode' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageHtTrendmode', 'type' => 'read', 'name' => 'Ht Trendmode', 'description' => 'Fetch Alpha Vantage technical indicator data for HT_TRENDMODE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_income_statement' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageIncomeStatement', 'type' => 'read', 'name' => 'Income Statement', 'description' => 'Fetch Alpha Vantage company fundamental data for INCOME_STATEMENT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_index_catalog' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageIndexCatalog', 'type' => 'read', 'name' => 'Index Catalog', 'description' => 'Fetch Alpha Vantage index data for INDEX_CATALOG.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_index_data' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageIndexData', 'type' => 'read', 'name' => 'Index Data', 'description' => 'Fetch Alpha Vantage index data for INDEX_DATA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_inflation' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageInflation', 'type' => 'read', 'name' => 'Inflation', 'description' => 'Fetch Alpha Vantage economic indicator data for INFLATION.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_insider_transactions' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageInsiderTransactions', 'type' => 'read', 'name' => 'Insider Transactions', 'description' => 'Fetch Alpha Vantage company fundamental data for INSIDER_TRANSACTIONS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_institutional_holdings' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageInstitutionalHoldings', 'type' => 'read', 'name' => 'Institutional Holdings', 'description' => 'Fetch Alpha Vantage company fundamental data for INSTITUTIONAL_HOLDINGS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ipo_calendar' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageIpoCalendar', 'type' => 'read', 'name' => 'Ipo Calendar', 'description' => 'Fetch Alpha Vantage calendar/listing data for IPO_CALENDAR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_kama' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageKama', 'type' => 'read', 'name' => 'Kama', 'description' => 'Fetch Alpha Vantage technical indicator data for KAMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_listing_status' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageListingStatus', 'type' => 'read', 'name' => 'Listing Status', 'description' => 'Fetch Alpha Vantage calendar/listing data for LISTING_STATUS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_macd' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMacd', 'type' => 'read', 'name' => 'Macd', 'description' => 'Fetch Alpha Vantage technical indicator data for MACD.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_macdext' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMacdext', 'type' => 'read', 'name' => 'Macdext', 'description' => 'Fetch Alpha Vantage technical indicator data for MACDEXT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_mama' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMama', 'type' => 'read', 'name' => 'Mama', 'description' => 'Fetch Alpha Vantage technical indicator data for MAMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_market_status' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMarketStatus', 'type' => 'read', 'name' => 'Market Status', 'description' => 'Fetch Alpha Vantage global market open and closure status.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_mfi' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMfi', 'type' => 'read', 'name' => 'Mfi', 'description' => 'Fetch Alpha Vantage technical indicator data for MFI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_midpoint' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMidpoint', 'type' => 'read', 'name' => 'Midpoint', 'description' => 'Fetch Alpha Vantage technical indicator data for MIDPOINT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_midprice' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMidprice', 'type' => 'read', 'name' => 'Midprice', 'description' => 'Fetch Alpha Vantage technical indicator data for MIDPRICE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_minus_di' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMinusDi', 'type' => 'read', 'name' => 'Minus Di', 'description' => 'Fetch Alpha Vantage technical indicator data for MINUS_DI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_minus_dm' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMinusDm', 'type' => 'read', 'name' => 'Minus Dm', 'description' => 'Fetch Alpha Vantage technical indicator data for MINUS_DM.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_mom' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageMom', 'type' => 'read', 'name' => 'Mom', 'description' => 'Fetch Alpha Vantage technical indicator data for MOM.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_natr' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageNatr', 'type' => 'read', 'name' => 'Natr', 'description' => 'Fetch Alpha Vantage technical indicator data for NATR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_natural_gas' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageNaturalGas', 'type' => 'read', 'name' => 'Natural Gas', 'description' => 'Fetch Alpha Vantage commodity data for NATURAL_GAS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_news_sentiment' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageNewsSentiment', 'type' => 'read', 'name' => 'News Sentiment', 'description' => 'Fetch Alpha Vantage intelligence data for NEWS_SENTIMENT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_nonfarm_payroll' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageNonfarmPayroll', 'type' => 'read', 'name' => 'Nonfarm Payroll', 'description' => 'Fetch Alpha Vantage economic indicator data for NONFARM_PAYROLL.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_obv' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageObv', 'type' => 'read', 'name' => 'Obv', 'description' => 'Fetch Alpha Vantage technical indicator data for OBV.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_overview' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageOverview', 'type' => 'read', 'name' => 'Overview', 'description' => 'Fetch Alpha Vantage company fundamental data for OVERVIEW.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_plus_di' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantagePlusDi', 'type' => 'read', 'name' => 'Plus Di', 'description' => 'Fetch Alpha Vantage technical indicator data for PLUS_DI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_plus_dm' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantagePlusDm', 'type' => 'read', 'name' => 'Plus Dm', 'description' => 'Fetch Alpha Vantage technical indicator data for PLUS_DM.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ppo' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantagePpo', 'type' => 'read', 'name' => 'Ppo', 'description' => 'Fetch Alpha Vantage technical indicator data for PPO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_realtime_bulk_quotes' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealtimeBulkQuotes', 'type' => 'read', 'name' => 'Realtime Bulk Quotes', 'description' => 'Fetch Alpha Vantage equity market data for REALTIME_BULK_QUOTES.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_realtime_options' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealtimeOptions', 'type' => 'read', 'name' => 'Realtime Options', 'description' => 'Fetch Alpha Vantage US options data for REALTIME_OPTIONS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_realtime_put_call_ratio' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealtimePutCallRatio', 'type' => 'read', 'name' => 'Realtime Put Call Ratio', 'description' => 'Fetch Alpha Vantage US options data for REALTIME_PUT_CALL_RATIO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_realtime_volume_open_interest_ratio' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealtimeVolumeOpenInterestRatio', 'type' => 'read', 'name' => 'Realtime Volume Open Interest Ratio', 'description' => 'Fetch Alpha Vantage US options data for REALTIME_VOLUME_OPEN_INTEREST_RATIO.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_real_gdp' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealGdp', 'type' => 'read', 'name' => 'Real Gdp', 'description' => 'Fetch Alpha Vantage economic indicator data for REAL_GDP.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_real_gdp_per_capita' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRealGdpPerCapita', 'type' => 'read', 'name' => 'Real Gdp Per Capita', 'description' => 'Fetch Alpha Vantage economic indicator data for REAL_GDP_PER_CAPITA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_retail_sales' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRetailSales', 'type' => 'read', 'name' => 'Retail Sales', 'description' => 'Fetch Alpha Vantage economic indicator data for RETAIL_SALES.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_roc' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRoc', 'type' => 'read', 'name' => 'Roc', 'description' => 'Fetch Alpha Vantage technical indicator data for ROC.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_rocr' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRocr', 'type' => 'read', 'name' => 'Rocr', 'description' => 'Fetch Alpha Vantage technical indicator data for ROCR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_rsi' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageRsi', 'type' => 'read', 'name' => 'Rsi', 'description' => 'Fetch Alpha Vantage technical indicator data for RSI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_sar' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSar', 'type' => 'read', 'name' => 'Sar', 'description' => 'Fetch Alpha Vantage technical indicator data for SAR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_shares_outstanding' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSharesOutstanding', 'type' => 'read', 'name' => 'Shares Outstanding', 'description' => 'Fetch Alpha Vantage company fundamental data for SHARES_OUTSTANDING.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_sma' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSma', 'type' => 'read', 'name' => 'Sma', 'description' => 'Fetch Alpha Vantage technical indicator data for SMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_splits' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSplits', 'type' => 'read', 'name' => 'Splits', 'description' => 'Fetch Alpha Vantage company fundamental data for SPLITS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_stoch' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageStoch', 'type' => 'read', 'name' => 'Stoch', 'description' => 'Fetch Alpha Vantage technical indicator data for STOCH.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_stochf' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageStochf', 'type' => 'read', 'name' => 'Stochf', 'description' => 'Fetch Alpha Vantage technical indicator data for STOCHF.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_stochrsi' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageStochrsi', 'type' => 'read', 'name' => 'Stochrsi', 'description' => 'Fetch Alpha Vantage technical indicator data for STOCHRSI.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_sugar' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSugar', 'type' => 'read', 'name' => 'Sugar', 'description' => 'Fetch Alpha Vantage commodity data for SUGAR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_symbol_search' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageSymbolSearch', 'type' => 'read', 'name' => 'Symbol Search', 'description' => 'Search Alpha Vantage symbols by keywords.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_t3' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageT3', 'type' => 'read', 'name' => 'T3', 'description' => 'Fetch Alpha Vantage technical indicator data for T3.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_tema' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTema', 'type' => 'read', 'name' => 'Tema', 'description' => 'Fetch Alpha Vantage technical indicator data for TEMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_daily' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesDaily', 'type' => 'read', 'name' => 'Time Series Daily', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_DAILY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_daily_adjusted' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesDailyAdjusted', 'type' => 'read', 'name' => 'Time Series Daily Adjusted', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_DAILY_ADJUSTED.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_intraday' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesIntraday', 'type' => 'read', 'name' => 'Time Series Intraday', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_INTRADAY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_monthly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesMonthly', 'type' => 'read', 'name' => 'Time Series Monthly', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_MONTHLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_monthly_adjusted' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesMonthlyAdjusted', 'type' => 'read', 'name' => 'Time Series Monthly Adjusted', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_MONTHLY_ADJUSTED.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_weekly' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesWeekly', 'type' => 'read', 'name' => 'Time Series Weekly', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_WEEKLY.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_time_series_weekly_adjusted' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTimeSeriesWeeklyAdjusted', 'type' => 'read', 'name' => 'Time Series Weekly Adjusted', 'description' => 'Fetch Alpha Vantage equity market data for TIME_SERIES_WEEKLY_ADJUSTED.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_top_gainers_losers' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTopGainersLosers', 'type' => 'read', 'name' => 'Top Gainers Losers', 'description' => 'Fetch Alpha Vantage intelligence data for TOP_GAINERS_LOSERS.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_trange' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTrange', 'type' => 'read', 'name' => 'Trange', 'description' => 'Fetch Alpha Vantage technical indicator data for TRANGE.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_treasury_yield' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTreasuryYield', 'type' => 'read', 'name' => 'Treasury Yield', 'description' => 'Fetch Alpha Vantage economic indicator data for TREASURY_YIELD.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_trima' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTrima', 'type' => 'read', 'name' => 'Trima', 'description' => 'Fetch Alpha Vantage technical indicator data for TRIMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_trix' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageTrix', 'type' => 'read', 'name' => 'Trix', 'description' => 'Fetch Alpha Vantage technical indicator data for TRIX.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_ultosc' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageUltosc', 'type' => 'read', 'name' => 'Ultosc', 'description' => 'Fetch Alpha Vantage technical indicator data for ULTOSC.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_unemployment' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageUnemployment', 'type' => 'read', 'name' => 'Unemployment', 'description' => 'Fetch Alpha Vantage economic indicator data for UNEMPLOYMENT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_vwap' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageVwap', 'type' => 'read', 'name' => 'Vwap', 'description' => 'Fetch Alpha Vantage technical indicator data for VWAP.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_wheat' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageWheat', 'type' => 'read', 'name' => 'Wheat', 'description' => 'Fetch Alpha Vantage commodity data for WHEAT.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_willr' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageWillr', 'type' => 'read', 'name' => 'Willr', 'description' => 'Fetch Alpha Vantage technical indicator data for WILLR.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_wma' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageWma', 'type' => 'read', 'name' => 'Wma', 'description' => 'Fetch Alpha Vantage technical indicator data for WMA.', 'icon' => 'ph:chart-line'],
            'alpha_vantage_wti' => ['class' => 'OpenCompany\\Integrations\\AlphaVantage\\Tools\\AlphaVantageWti', 'type' => 'read', 'name' => 'Wti', 'description' => 'Fetch Alpha Vantage commodity data for WTI.', 'icon' => 'ph:chart-line'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an Alpha Vantage tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AlphaVantageService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AlphaVantageService(apiKey: $creds->get('alpha-vantage', 'api_key', '', $account));
        }

        return app(AlphaVantageService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/alpha-vantage.md';
    }
}
