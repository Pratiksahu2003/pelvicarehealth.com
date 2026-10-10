<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillDoctorState extends Command
{
    protected $signature   = 'doctors:backfill-state
                              {--dry-run : Preview changes without writing to the database}';
    protected $description = 'Safely back-fill the state column for existing doctor profiles using city → state mapping.';

    /**
     * Comprehensive city-to-State/UT map for India.
     * Keys are lowercase city names (or existing city column values);
     * values match exactly a key in config(pelvicare.locations).
     */
    private array $cityToState = [
        // ── Andhra Pradesh ──────────────────────────────────────────────
        'visakhapatnam' => 'Andhra Pradesh', 'vizag' => 'Andhra Pradesh',
        'vijayawada'    => 'Andhra Pradesh', 'guntur' => 'Andhra Pradesh',
        'tirupati'      => 'Andhra Pradesh', 'kurnool'=> 'Andhra Pradesh',
        'rajahmundry'   => 'Andhra Pradesh', 'nellore'=> 'Andhra Pradesh',
        'kakinada'      => 'Andhra Pradesh', 'amaravati' => 'Andhra Pradesh',

        // ── Arunachal Pradesh ────────────────────────────────────────────
        'itanagar' => 'Arunachal Pradesh',

        // ── Assam ────────────────────────────────────────────────────────
        'guwahati' => 'Assam', 'silchar' => 'Assam', 'dibrugarh' => 'Assam',
        'jorhat'   => 'Assam', 'dispur'  => 'Assam',

        // ── Bihar ────────────────────────────────────────────────────────
        'patna'      => 'Bihar', 'gaya'    => 'Bihar', 'muzaffarpur' => 'Bihar',
        'bhagalpur'  => 'Bihar', 'bodh gaya' => 'Bihar',

        // ── Chhattisgarh ─────────────────────────────────────────────────
        'raipur'    => 'Chhattisgarh', 'bhilai'  => 'Chhattisgarh',
        'bilaspur'  => 'Chhattisgarh', 'korba'   => 'Chhattisgarh',
        'durg'      => 'Chhattisgarh', 'jagdalpur' => 'Chhattisgarh',

        // ── Goa ──────────────────────────────────────────────────────────
        'panaji'  => 'Goa', 'margao' => 'Goa', 'vasco da gama' => 'Goa',
        'panjim'  => 'Goa', 'mapusa' => 'Goa',

        // ── Gujarat ──────────────────────────────────────────────────────
        'ahmedabad'  => 'Gujarat', 'surat'     => 'Gujarat', 'vadodara'  => 'Gujarat',
        'rajkot'     => 'Gujarat', 'gandhinagar'=> 'Gujarat', 'bhavnagar' => 'Gujarat',
        'jamnagar'   => 'Gujarat', 'junagarh'  => 'Gujarat', 'anand'     => 'Gujarat',
        'navsari'    => 'Gujarat', 'baroda'    => 'Gujarat',

        // ── Haryana ──────────────────────────────────────────────────────
        'gurgaon'    => 'Haryana', 'gurugram'  => 'Haryana', 'faridabad'  => 'Haryana',
        'panipat'    => 'Haryana', 'ambala'    => 'Haryana', 'hisar'      => 'Haryana',
        'rohtak'     => 'Haryana', 'karnal'    => 'Haryana', 'sonipat'    => 'Haryana',

        // ── Himachal Pradesh ─────────────────────────────────────────────
        'shimla'   => 'Himachal Pradesh', 'manali'   => 'Himachal Pradesh',
        'dharamsala'=> 'Himachal Pradesh', 'solan'   => 'Himachal Pradesh',

        // ── Jharkhand ────────────────────────────────────────────────────
        'ranchi'     => 'Jharkhand', 'jamshedpur' => 'Jharkhand',
        'dhanbad'    => 'Jharkhand', 'bokaro'    => 'Jharkhand',

        // ── Karnataka ────────────────────────────────────────────────────
        'bengaluru'  => 'Karnataka', 'bangalore'  => 'Karnataka',
        'mysuru'     => 'Karnataka', 'mysore'     => 'Karnataka',
        'hubli'      => 'Karnataka', 'mangaluru'  => 'Karnataka',
        'mangalore'  => 'Karnataka', 'belgaum'    => 'Karnataka',
        'belagavi'   => 'Karnataka', 'davangere'  => 'Karnataka',
        'bellary'    => 'Karnataka', 'vijayapura' => 'Karnataka',
        'tumkur'     => 'Karnataka', 'udupi'      => 'Karnataka',

        // ── Kerala ───────────────────────────────────────────────────────
        'thiruvananthapuram' => 'Kerala', 'trivandrum' => 'Kerala',
        'kochi'      => 'Kerala', 'cochin'     => 'Kerala',
        'kozhikode'  => 'Kerala', 'calicut'    => 'Kerala',
        'thrissur'   => 'Kerala', 'kollam'     => 'Kerala',
        'kannur'     => 'Kerala', 'palakkad'   => 'Kerala',
        'malappuram' => 'Kerala', 'alappuzha'  => 'Kerala',

        // ── Madhya Pradesh ───────────────────────────────────────────────
        'bhopal'     => 'Madhya Pradesh', 'indore'    => 'Madhya Pradesh',
        'jabalpur'   => 'Madhya Pradesh', 'gwalior'   => 'Madhya Pradesh',
        'ujjain'     => 'Madhya Pradesh', 'sagar'     => 'Madhya Pradesh',

        // ── Maharashtra ──────────────────────────────────────────────────
        'mumbai'     => 'Maharashtra', 'pune'      => 'Maharashtra',
        'nagpur'     => 'Maharashtra', 'nashik'    => 'Maharashtra',
        'aurangabad' => 'Maharashtra', 'solapur'   => 'Maharashtra',
        'thane'      => 'Maharashtra', 'navi mumbai'=> 'Maharashtra',
        'kolhapur'   => 'Maharashtra', 'amravati'  => 'Maharashtra',
        'nanded'     => 'Maharashtra', 'jalgaon'   => 'Maharashtra',
        'akola'      => 'Maharashtra', 'latur'     => 'Maharashtra',
        'dhule'      => 'Maharashtra', 'ahmednagar' => 'Maharashtra',

        // ── Manipur ──────────────────────────────────────────────────────
        'imphal' => 'Manipur',

        // ── Meghalaya ────────────────────────────────────────────────────
        'shillong' => 'Meghalaya',

        // ── Mizoram ──────────────────────────────────────────────────────
        'aizawl' => 'Mizoram',

        // ── Nagaland ─────────────────────────────────────────────────────
        'kohima' => 'Nagaland', 'dimapur' => 'Nagaland',

        // ── Odisha ───────────────────────────────────────────────────────
        'bhubaneswar' => 'Odisha', 'cuttack' => 'Odisha',
        'rourkela'   => 'Odisha', 'puri'    => 'Odisha',

        // ── Punjab ───────────────────────────────────────────────────────
        'ludhiana'  => 'Punjab', 'amritsar' => 'Punjab',
        'jalandhar' => 'Punjab', 'patiala'  => 'Punjab', 'bathinda'  => 'Punjab',

        // ── Rajasthan ────────────────────────────────────────────────────
        'jaipur'  => 'Rajasthan', 'jodhpur'  => 'Rajasthan',
        'udaipur' => 'Rajasthan', 'kota'     => 'Rajasthan',
        'ajmer'   => 'Rajasthan', 'bikaner'  => 'Rajasthan',
        'alwar'   => 'Rajasthan', 'bharatpur'=> 'Rajasthan',

        // ── Sikkim ───────────────────────────────────────────────────────
        'gangtok' => 'Sikkim',

        // ── Tamil Nadu ───────────────────────────────────────────────────
        'chennai'    => 'Tamil Nadu', 'madras'     => 'Tamil Nadu',
        'coimbatore' => 'Tamil Nadu', 'madurai'    => 'Tamil Nadu',
        'tiruchirappalli' => 'Tamil Nadu', 'trichy' => 'Tamil Nadu',
        'salem'      => 'Tamil Nadu', 'tirunelveli'=> 'Tamil Nadu',
        'vellore'    => 'Tamil Nadu', 'erode'      => 'Tamil Nadu',
        'tiruppur'   => 'Tamil Nadu', 'ambattur'   => 'Tamil Nadu',

        // ── Telangana ────────────────────────────────────────────────────
        'hyderabad'  => 'Telangana', 'warangal'   => 'Telangana',
        'nizamabad'  => 'Telangana', 'karimnagar' => 'Telangana',
        'khammam'    => 'Telangana', 'secunderabad'=> 'Telangana',

        // ── Tripura ──────────────────────────────────────────────────────
        'agartala' => 'Tripura',

        // ── Uttar Pradesh ────────────────────────────────────────────────
        'lucknow'    => 'Uttar Pradesh', 'kanpur'    => 'Uttar Pradesh',
        'agra'       => 'Uttar Pradesh', 'varanasi'  => 'Uttar Pradesh',
        'allahabad'  => 'Uttar Pradesh', 'prayagraj' => 'Uttar Pradesh',
        'meerut'     => 'Uttar Pradesh', 'noida'     => 'Uttar Pradesh',
        'greater noida' => 'Uttar Pradesh', 'ghaziabad' => 'Uttar Pradesh',
        'bareilly'   => 'Uttar Pradesh', 'aligarh'   => 'Uttar Pradesh',
        'moradabad'  => 'Uttar Pradesh', 'mathura'   => 'Uttar Pradesh',
        'gorakhpur'  => 'Uttar Pradesh', 'faizabad'  => 'Uttar Pradesh',
        'ayodhya'    => 'Uttar Pradesh', 'jhansi'    => 'Uttar Pradesh',

        // ── Uttarakhand ──────────────────────────────────────────────────
        'dehradun'   => 'Uttarakhand', 'haridwar'  => 'Uttarakhand',
        'rishikesh'  => 'Uttarakhand', 'nainital'  => 'Uttarakhand',
        'roorkee'    => 'Uttarakhand',

        // ── West Bengal ──────────────────────────────────────────────────
        'kolkata'    => 'West Bengal', 'calcutta'  => 'West Bengal',
        'howrah'     => 'West Bengal', 'durgapur'  => 'West Bengal',
        'siliguri'   => 'West Bengal', 'asansol'   => 'West Bengal',

        // ── Andaman and Nicobar Islands ──────────────────────────────────
        'port blair' => 'Andaman and Nicobar Islands',

        // ── Chandigarh ───────────────────────────────────────────────────
        'chandigarh' => 'Chandigarh',

        // ── Delhi ────────────────────────────────────────────────────────
        'delhi'       => 'Delhi', 'new delhi'    => 'Delhi',
        'south delhi' => 'Delhi', 'north delhi'  => 'Delhi',
        'east delhi'  => 'Delhi', 'west delhi'   => 'Delhi',
        'dwarka'      => 'Delhi', 'rohini'       => 'Delhi',
        'janakpuri'   => 'Delhi', 'lajpat nagar' => 'Delhi',

        // ── Jammu and Kashmir ────────────────────────────────────────────
        'srinagar' => 'Jammu and Kashmir', 'jammu' => 'Jammu and Kashmir',

        // ── Ladakh ───────────────────────────────────────────────────────
        'leh' => 'Ladakh', 'kargil' => 'Ladakh',

        // ── Lakshadweep ──────────────────────────────────────────────────
        'kavaratti' => 'Lakshadweep',

        // ── Puducherry ───────────────────────────────────────────────────
        'puducherry' => 'Puducherry', 'pondicherry'=> 'Puducherry',

        // ── Dadra and Nagar Haveli ───────────────────────────────────────
        'silvassa' => 'Dadra and Nagar Haveli and Daman and Diu',
        'daman'    => 'Dadra and Nagar Haveli and Daman and Diu',
        'diu'      => 'Dadra and Nagar Haveli and Daman and Diu',
    ];

    public function handle(): int
    {
        $isDryRun   = $this->option('dry-run');
        $validStates = array_keys(config('pelvicare.locations', []));

        if (empty($validStates)) {
            $this->error('pelvicare.locations config is empty — cannot proceed.');
            return self::FAILURE;
        }

        // Fetch all doctor profiles where state is null or empty
        $rows = DB::table('doctor_profiles')
            ->whereNull('state')
            ->orWhere('state', '')
            ->select('id', 'city', 'state')
            ->get();

        if ($rows->isEmpty()) {
            $this->info('✅  All doctor profiles already have a state value. Nothing to do.');
            return self::SUCCESS;
        }

        $this->info("Found {$rows->count()} doctor profile(s) with no state value.");
        $this->newLine();

        $updated   = 0;
        $skipped   = 0;
        $noMatch   = [];

        $tableData = [];

        foreach ($rows as $row) {
            $cityRaw    = trim($row->city ?? '');
            $cityLower  = strtolower($cityRaw);
            $resolvedState = null;

            // 1. City value IS already a valid State/UT name (e.g. "Delhi" was stored as-is)
            if (in_array($cityRaw, $validStates)) {
                $resolvedState = $cityRaw;
            }
            // 2. Try lowercase city → state mapping
            elseif (isset($this->cityToState[$cityLower])) {
                $resolvedState = $this->cityToState[$cityLower];
            }
            // 3. Partial / trimmed match as a last resort (handles typos with trailing spaces etc.)
            else {
                foreach ($this->cityToState as $key => $state) {
                    if (str_contains($cityLower, $key) || str_contains($key, $cityLower)) {
                        $resolvedState = $state;
                        break;
                    }
                }
            }

            if ($resolvedState) {
                $tableData[] = [$row->id, $cityRaw ?: '(empty)', $resolvedState, '✅ Will update'];

                if (! $isDryRun) {
                    DB::table('doctor_profiles')
                        ->where('id', $row->id)
                        ->update(['state' => $resolvedState]);
                }
                $updated++;
            } else {
                $tableData[] = [$row->id, $cityRaw ?: '(empty)', '—', '⚠️  No match'];
                $noMatch[]   = "  Profile #{$row->id}: city = \"{$cityRaw}\"";
                $skipped++;
            }
        }

        // Pretty table output
        $this->table(['Profile ID', 'City (existing)', 'State resolved', 'Action'], $tableData);
        $this->newLine();

        if ($isDryRun) {
            $this->warn('DRY RUN — no database writes were made.');
            $this->info("Would update : {$updated}");
            $this->info("Would skip   : {$skipped} (city not recognised)");
        } else {
            $this->info("✅  Updated : {$updated} profile(s)");
            if ($skipped > 0) {
                $this->warn("⚠️  Skipped  : {$skipped} profile(s) — city value could not be mapped to a State/UT.");
            }
        }

        if (! empty($noMatch)) {
            $this->newLine();
            $this->warn('Unresolved profiles (state left as NULL — update manually via the doctor profile screen):');
            foreach ($noMatch as $line) {
                $this->line($line);
            }
        }

        return self::SUCCESS;
    }
}
