# Paycheck Check — Requirements Ledger

**Project:** `pay-app`  
**User-facing name:** Paycheck Check  
**Purpose:** Estimate and verify a user's paycheck by comparing calculated hours/pay/taxes/deductions with actual pay-stub values.

## How to use this ledger

- **LOCKED** = owner-approved requirement. Treat as authoritative.
- **PROPOSED** = AI/developer recommendation. Do not implement as a requirement until approved.
- **UNRESOLVED** = genuine owner decision still required.
- Do not re-ask questions already marked LOCKED.
- Do not invent missing business rules.
- When a requirement changes, update the existing entry and check dependent entries for contradictions.
- Keep implementation prompts task-specific. This file is the project requirements source of truth.

---

# 1. Product and Scope

| ID | Status | Requirement |
|---|---|---|
| APP-001 | LOCKED | Paycheck Check estimates regular hours/pay, overtime hours/pay, premium pay, gross pay, deductions, taxes, and estimated net pay according to the enabled feature tier. |
| APP-002 | LOCKED | The application compares estimates against actual paycheck/pay-stub values entered by the user. |
| APP-003 | LOCKED | Paycheck Check is not payroll software, a payroll replacement, tax-return preparation software, or a substitute for a tax professional. |
| APP-004 | LOCKED | Calculation pages must clearly communicate limitations and estimates; limitations must not exist only on an About page. |
| APP-005 | LOCKED | Comparison language must remain neutral and must not accuse an employer or payroll department of making an error. |
| APP-006 | LOCKED | The application should encourage reviewing the actual pay stub and contacting payroll when a difference needs investigation. |
| APP-007 | LOCKED | The application is mobile-first and should use simple, large, touch-friendly controls. |
| APP-008 | LOCKED | Each job is independent for paycheck calculations. There is no cross-job overtime or combined paycheck calculation. |
| APP-009 | LOCKED | Underlying data must remain granular enough to support future cross-job reporting even though current calculations are job-independent. |
| APP-010 | LOCKED | Paycheck Check estimates are based on information supplied by the user and the historical paycheck information available to the application. Estimates are only as accurate as the information provided. |
| APP-011 | LOCKED | Paycheck Check does not guarantee that estimated wages, overtime, taxes, deductions, or net pay will match an actual paycheck. |
| APP-012 | LOCKED | Users are responsible for reviewing their results and investigating discrepancies between Paycheck Check estimates and their actual paychecks, at both the pay-period level and the annual-summary level. |
| APP-013 | LOCKED | If a discrepancy needs investigation, users should review the actual pay stub and consult their employer's payroll department, the appropriate tax authority, or a qualified tax professional when necessary. |
| APP-014 | LOCKED | Accuracy and responsibility notices must appear during onboarding, on paycheck comparison pages, and on annual summary pages. The detailed explanation may also appear on an About, Help, or methodology page. |
| APP-015 | LOCKED | The application must not use reassuring language that implies an estimate has been verified merely because it closely matches previous paychecks. Historical observations improve estimates but do not independently establish that the underlying payroll or withholding is correct. |

# 2. Technical Stack and Development Rules

| ID | Status | Requirement |
|---|---|---|
| TECH-001 | LOCKED | Application uses Laravel with Inertia React. |
| TECH-002 | LOCKED | Current verified project uses Laravel Framework 13.30.1 and PHP 8.4 in Docker; PHP requirement is `^8.3`. |
| TECH-003 | LOCKED | Current verified packages include Filament 5.9.0, Inertia Laravel 3.3.2, Inertia React 3.7.0, Wayfinder 0.1.21, Laravel Boost 2.9.1, Pest 5.1.3, React 19.2.8, Tailwind CSS 4.3.3, Vite 8.2.2, TypeScript 5.9.3, and Fortify 1.39.0. |
| TECH-004 | LOCKED | Laravel Boost MCP must be used for Laravel-specific guidance and verification whenever relevant. |
| TECH-005 | LOCKED | The actual repository, installed packages, schema, routes, authentication, existing code, Laravel Boost context, and current applicable documentation are authoritative over remembered APIs or assumptions. |
| TECH-006 | LOCKED | Do not invent Laravel APIs. Verify uncertain APIs against the installed application, Laravel Boost, and applicable documentation. |
| TECH-007 | LOCKED | Do not install, remove, replace, or introduce third-party Composer/npm packages without explicit owner approval. |
| TECH-008 | LOCKED | Prefer existing Laravel/framework functionality and already-installed packages. |
| TECH-009 | LOCKED | Prefer the simplest maintainable implementation; avoid unnecessary abstractions and unrelated refactoring. |
| TECH-010 | LOCKED | User prefers JavaScript/JSX where practical, but do not convert the existing TypeScript-first starter unnecessarily. |
| TECH-011 | LOCKED | Business/domain calculations belong in the server/domain layer rather than React presentation components. |
| TECH-012 | LOCKED | No application code should be created until the architecture/domain review has been approved. |

# 3. Privacy, Accounts, and Security

| ID | Status | Requirement |
|---|---|---|
| PRIV-001 | LOCKED | Account required. |
| PRIV-002 | LOCKED | Collect the minimum PII necessary. |
| PRIV-003 | LOCKED | Do not require name, phone, home address, employer name, employee ID, SSN, bank information, or similar PII unless a specifically approved requirement makes it necessary. |
| PRIV-004 | LOCKED | User data must be strongly isolated so one account cannot access another user's paycheck/job data. |
| PRIV-005 | LOCKED | Internal user relationships use the normal auto-incrementing `users.id`. A separate public Profile ID uses format `ABCD-000000`, is independent of `users.id`, is not a foreign key/index used for relationships, and may be provided by the user to Tech Support for account identification. |
| PRIV-006 | LOCKED | Paycheck Check must support multiple secure authentication choices: traditional email + password, an optional Passkey option, and an additional secure quick-login option if the installed Laravel/browser capabilities can provide one. Passkeys are not mandatory. |
| PRIV-007 | LOCKED | The custom PIN-based quick-login concept is removed. Do not design or implement a Paycheck Check-specific PIN authentication system unless the owner explicitly approves a future change. |
| PRIV-008 | LOCKED | Passwords, PINs, or equivalent authentication secrets must never be literally stored in browser storage. Prefer device-held credentials and standards-based/browser-native authentication mechanisms where supported. |
| PRIV-009 | LOCKED | The exact quick-login mechanism must be determined by architecture review using Laravel 13, the installed authentication stack, Vite/React, and browser/platform APIs before considering any new dependency. |
| PRIV-010 | LOCKED | The existing Laravel Passkeys capability must be evaluated and may be offered as one user-selectable authentication option. It must not be made mandatory. |
| PRIV-011 | LOCKED | A quick-login/trusted-device credential, if supported by the final architecture, must be server-authoritative, revocable, replaceable, and securely bound to the account/device credential. Do not rely on device fingerprinting or an exposed/encrypted device number as the security mechanism. |
| PRIV-012 | LOCKED | Only one remembered/trusted quick-login device may be active for a user at a time. Registering a new trusted device invalidates the previously trusted device's quick-login credential. |
| PRIV-013 | LOCKED | When a new device replaces the existing trusted device, the old device must no longer be able to use quick login and must fall back to traditional email + password authentication. |
| PRIV-014 | LOCKED | The user must have a Profile/Security mechanism to clear/revoke the active quick-login/trusted-device credential and establish a replacement where the selected mechanism supports it. |
| PRIV-015 | LOCKED | When a new trusted device replaces an old one, the user should be clearly informed that the previous device can no longer use quick login and will require the password. |
| PRIV-016 | LOCKED | Sensitive account changes must require password or another explicitly approved strong step-up authentication even when quick login is enabled. This includes profile changes, Job Settings changes, adding/removing jobs, and account deletion. |
| PRIV-016 | LOCKED | Development/test seed credentials may use `XXX-000000`, `demo@email.com`, and `password`; these values are never production credentials. |
| PRIV-017 | LOCKED | Do not expose sensitive paycheck, tax, deduction, or account information unnecessarily in logs, exceptions, debugging output, analytics, or telemetry. |
| PRIV-018 | LOCKED | Any feature requiring additional personal information must identify the requirement before implementation. |
| SEC-001 | LOCKED | Authorization and data-access checks must enforce user ownership/isolation at the application/domain boundary, not merely through UI restrictions. |
| SEC-002 | LOCKED | Sensitive historical calculations and retained data must be protected by the same ownership rules as current data. |
| SEC-003 | LOCKED | No security feature, package, or external service may be introduced without approval. |
| SEC-004 | LOCKED | PWA functionality must use native browser/platform capabilities and the existing Laravel/Vite/React stack where practical; do not add a third-party PWA/authentication package without explicit approval. |
| SEC-005 | LOCKED | PWA installability, authentication, and trusted-device behavior are separate concerns and must be architected separately. |
| SEC-006 | LOCKED | Do not cache sensitive paycheck, tax, deduction, or account data for offline use unless a separate offline-data requirement is explicitly approved. |

# 4. PWA and Quick Authentication

| ID | Status | Requirement |
|---|---|---|
| PWA-001 | LOCKED | Paycheck Check should be evaluated for installable Progressive Web App support using capabilities already available in Laravel 13, Vite, React, and supported browsers. |
| PWA-002 | LOCKED | Before implementation, review current first-party browser/PWA requirements for manifest, icons, start URL, standalone display, HTTPS/secure context, and service-worker requirements. |
| PWA-003 | LOCKED | A service worker should be used only where it provides an approved benefit; do not add one merely because the application is a PWA. |
| PWA-004 | LOCKED | The application should provide an app-like install experience on supported mobile, tablet, and desktop platforms where the browser supports installation. |
| PWA-005 | LOCKED | PWA functionality must not require storing the user's password or PIN in the browser. |
| PWA-006 | LOCKED | The authentication experience must offer traditional email + password login as a permanent fallback. |
| PWA-007 | LOCKED | Passkey authentication should be offered as an optional user choice where supported by the installed Laravel/Fortify/browser stack. |
| PWA-008 | LOCKED | A separate secure quick-login option should be provided if the architecture review determines that Laravel 13, the installed authentication stack, and browser/platform APIs can provide it securely without a new dependency. |
| PWA-009 | LOCKED | The quick-login option must not use a custom Paycheck Check PIN and must not store the user's password/PIN or equivalent secret literally in browser storage. |
| PWA-010 | LOCKED | If multiple secure quick-login/authentication methods are supported, the user should be allowed to choose which method to register/use. |
| PWA-011 | LOCKED | The architecture review must determine whether existing Laravel Passkeys/WebAuthn support can provide the desired device-held credential experience without adding a third-party dependency. |
| PWA-012 | LOCKED | The architecture review must determine whether a secure server-authoritative trusted-device credential can provide the desired quick-login experience using existing Laravel authentication/session capabilities and browser APIs, without device fingerprinting. |
| PWA-013 | LOCKED | Only one remembered/trusted quick-login device may be active at a time; registering a replacement invalidates the prior trusted-device credential. |
| PWA-014 | LOCKED | A replaced trusted device must fall back to traditional email + password authentication. |
| PWA-015 | LOCKED | Profile/Security must provide a way to revoke the active quick-login/trusted-device credential and establish a replacement where the selected mechanism supports it. |
| PWA-016 | LOCKED | PWA installability and authentication are separate concerns and must be architected separately. |
| PWA-017 | LOCKED | Do not cache sensitive paycheck, tax, deduction, or account data for offline use unless a separate offline-data requirement is explicitly approved. |

# 5. Jobs

| ID | Status | Requirement |
|---|---|---|
| JOB-001 | LOCKED | A user may have multiple jobs. |
| JOB-002 | LOCKED | Each job has independent paycheck calculations. |
| JOB-003 | LOCKED | Dashboard supports left/right swipe between job-specific views. |
| JOB-004 | LOCKED | Each job has a user-editable title in Job Settings. |
| JOB-005 | LOCKED | Default job titles are Job 1, Job 2, Job 3, etc. |
| JOB-006 | LOCKED | Current job title appears prominently above Hours Worked on the dashboard. |
| JOB-007 | LOCKED | Job Settings is configuration only. Actual Pay is a separate workflow/page. |
| JOB-008 | LOCKED | Each job has its own pay rate. |
| JOB-009 | LOCKED | Rate changes must preserve historical rate information with effective dates. |
| JOB-010 | LOCKED | A note is recorded when a pay rate changes. Historical job settings/rates must remain available when they affect historical calculations. |

# 6. Pay Schedules and Pay Periods

| ID | Status | Requirement |
|---|---|---|
| PAY-001 | LOCKED | Supported pay schedules: weekly, every other week (biweekly), and twice a month (semimonthly). |
| PAY-002 | LOCKED | For semimonthly schedules, the user selects the two pay dates. |
| PAY-003 | LOCKED | February 28/29 is treated as the end-of-month equivalent for configured dates such as the 30th/31st. |
| PAY-004 | LOCKED | A work week is a separate domain concept from a pay period. |
| PAY-005 | LOCKED | The work week drives overtime calculations. |
| PAY-006 | LOCKED | The application must correctly handle work weeks crossing pay-period boundaries. |
| PAY-007 | LOCKED | The application must track the number of pay periods/paychecks in each calendar month for deduction-frequency calculations. |
| PAY-008 | LOCKED | Extra monthly paychecks continue normal hours, pay, premium, and tax calculations. |
| PAY-009 | LOCKED | Elective deductions whose scheduled monthly occurrences have already been satisfied are not subtracted from an extra paycheck's gross. |

# 7. Overtime

| ID | Status | Requirement |
|---|---|---|
| OT-001 | LOCKED | Weekly overtime is enabled by default. |
| OT-002 | LOCKED | Default weekly overtime threshold is 40 hours. |
| OT-003 | LOCKED | Daily overtime is optional and disabled by default. |
| OT-004 | LOCKED | Default daily overtime threshold is 8 hours when daily overtime is enabled. |
| OT-005 | LOCKED | Weekly and daily overtime thresholds are customizable. |
| OT-006 | LOCKED | Daily and weekly overtime interaction must not double-count the same hours. |
| OT-007 | LOCKED | Overtime is based on hours actually worked, not merely paid hours. |
| OT-008 | LOCKED | Sunday/holiday premium is not automatically treated as FLSA overtime. Premium pay, overtime pay, and qualified overtime compensation remain distinct concepts. |

# 8. Time Entry

| ID | Status | Requirement |
|---|---|---|
| TIME-001 | LOCKED | Time is stored as day-by-day actual timestamp records with start and end timestamps. |
| TIME-002 | LOCKED | Multiple start/end records may exist on the same day. |
| TIME-003 | LOCKED | Example: 9:00–12:00 plus 12:30–5:00 produces 7.5 worked hours. |
| TIME-004 | LOCKED | Add Time opens with current date/current time prefilled, but values are editable. |
| TIME-005 | LOCKED | A start-only record may be saved. |
| TIME-006 | LOCKED | Incomplete start/end records are highlighted and remain editable. |
| TIME-007 | LOCKED | Users may enter or edit historical dates/times. |
| TIME-008 | LOCKED | Overnight entries must calculate correctly. |
| TIME-009 | LOCKED | Lunch is not automatically deducted. UI should remind users that an employer may automatically deduct lunch. |
| TIME-010 | LOCKED | Regular time is worked time and counts toward overtime. |
| TIME-011 | LOCKED | Holiday worked entries support a rate of 1x, 1.5x, or 2x; hours count toward overtime. |
| TIME-012 | LOCKED | Holiday paid-not-worked entries are paid but do not count toward overtime hours. |
| TIME-013 | LOCKED | PTO is paid but not worked, does not count toward overtime, and uses the regular rate by default. |
| TIME-014 | LOCKED | Holiday/PTO/work dimensions remain granular dimensions of time entries rather than requiring separate reporting-only tables. |
| TIME-015 | LOCKED | Before a pay period closes, time entries may be added, edited, or deleted. |
| TIME-016 | LOCKED | After a pay period closes, its time entries are read-only. |
| TIME-017 | LOCKED | There is no Request Correction workflow. |
| TIME-018 | LOCKED | There is no user-facing unlock workflow for closed periods. |

# 9. Dashboard

| ID | Status | Requirement |
|---|---|---|
| DASH-001 | LOCKED | Dashboard is primarily quick time input, not a reporting dashboard. |
| DASH-002 | LOCKED | Display current pay period dates at the top. |
| DASH-003 | LOCKED | Display current job title prominently above Hours Worked. |
| DASH-004 | LOCKED | Display hours worked so far. |
| DASH-005 | LOCKED | Display overtime hours applicable to the current paycheck. |
| DASH-006 | LOCKED | Display estimated gross earned so far. |
| DASH-007 | LOCKED | Provide an easy Add Time button. |
| DASH-008 | LOCKED | Below the summary, show a date-by-date time-entry grid. |
| DASH-009 | LOCKED | All start/stop records for a date appear on one row. |
| DASH-010 | LOCKED | A date is clickable to edit its entries. |
| DASH-011 | LOCKED | Missing start/end data shows an inline red-background/white-text error cell that is clickable to edit. |
| DASH-012 | LOCKED | Saving an edited entry recalculates affected totals. |
| DASH-013 | LOCKED | Other summaries and graphs belong on other pages rather than the main time-entry dashboard. |

Main menu:
- Edit Profile
- Edit Job Settings
- View current pay period
- View current week
- View current pay period + last week
- Pay Summary: current pay period including applicable OT, MTD, YTD

# 10. Job Settings and Rate History

| ID | Status | Requirement |
|---|---|---|
| SET-001 | LOCKED | Job Settings contains job configuration rather than actual paycheck data. |
| SET-002 | LOCKED | Pay rate changes are versioned by effective date. |
| SET-003 | LOCKED | Historical rates must be used for historical calculations when applicable. |
| SET-004 | LOCKED | Rate changes require a note. |
| SET-005 | LOCKED | Deductions are configured from Job Settings using Add Deduction. |
| SET-006 | LOCKED | Deductions are optional and should be clearly described as improving estimate accuracy rather than being required. |

# 11. Tier 1 — Hours and Gross Pay

| ID | Status | Requirement |
|---|---|---|
| T1-001 | LOCKED | Tier 1 estimates regular hours, overtime hours, premium pay, regular pay, overtime pay, and gross pay. |
| T1-002 | LOCKED | User can enter actual regular hours, OT hours, regular pay, OT pay, premium pay where applicable, and gross pay from the actual stub. |
| T1-003 | LOCKED | Do not reverse-engineer missing actual values from insufficient data. |
| T1-004 | LOCKED | Actual Net Pay is optional and is for personal record/tracking only. |
| T1-005 | LOCKED | Tier 1 does not calculate or estimate net pay. |
| T1-006 | LOCKED | Actual Net Pay is never used to reverse-engineer taxes or deductions. |
| T1-007 | LOCKED | Actual Net Pay may appear in annual history/reporting. |

# 12. Tier 2 — Deductions and Net Estimate

| ID | Status | Requirement |
|---|---|---|
| T2-001 | LOCKED | Tier 2 adds deduction estimates and estimated net pay. |
| T2-002 | LOCKED | Deductions are configured in Job Settings using Add Deduction. |
| T2-003 | LOCKED | Each deduction has a name/type and frequency. |
| T2-004 | LOCKED | Frequency options are Per Pay (default), 2x a month, 4x a month, and Once a month. |
| T2-005 | LOCKED | Deduction type options include Medical, Vision, Dental, Legal, 401(k)/Retirement, and Miscellaneous/Other. |
| T2-006 | LOCKED | Medical, vision, dental, legal, and miscellaneous deductions use dollar amounts. |
| T2-007 | LOCKED | 401(k)/retirement uses a percentage. |
| T2-008 | LOCKED | There is no user-facing generic amount-vs-percentage selector. |
| T2-009 | LOCKED | Users may enter deductions individually or combine deductions with the same frequency into one total. |
| T2-010 | LOCKED | Separate entries improve tracking/comparison but are not required. |
| T2-011 | LOCKED | Elective deductions whose monthly scheduled occurrences are already satisfied are omitted from an extra paycheck. |
| T2-012 | LOCKED | Actual Pay supports entering actual paycheck deductions and comparing them with estimates. |
| T2-013 | LOCKED | Suggested explanatory text should tell users deductions are optional and can improve estimate accuracy. |
| T2-014 | LOCKED | Actual paycheck deductions support multiple records per paycheck/stub with Deduction Title, Frequency, Amount, User ID, and Job ID; each actual deduction is tied to the specific user and job for comparison and analytics. |

Suggested UI wording:
> Deductions are optional. You don't have to enter your deductions, but providing them can make your paycheck estimate more accurate. You can enter deductions individually for better tracking and comparison, or combine deductions into one total if that's easier.
>
> Tip: If several deductions have the same frequency, you can combine them into one amount instead of entering them separately.

# 13. Tier 3 — Withholding/Tax Estimate

| ID | Status | Requirement |
|---|---|---|
| T3-001 | LOCKED | Tier 3 adds paycheck withholding/tax estimation. |
| T3-002 | LOCKED | Tier 3 estimates paycheck withholding, not annual tax liability and not tax-return results. |
| T3-003 | LOCKED | Ask only the minimum tax questions needed for withholding estimation. |
| T3-004 | LOCKED | Filing status is collected as needed for withholding. |
| T3-005 | LOCKED | Dependents count/category is collected as needed for withholding. |
| T3-006 | LOCKED | Other W-4 adjustments are collected only if necessary. |
| T3-007 | LOCKED | Do not ask users for standard-vs-itemized deductions for paycheck withholding. |
| T3-008 | LOCKED | Do not collect SSNs, dependent names/SSNs/birth dates, detailed tax-return information, employer name, bank information, or similar unnecessary data. |
| T3-009 | LOCKED | Federal withholding rules use official IRS tax-year rules/tables. |
| T3-010 | LOCKED | State rules/publications are normalized into a versioned local database. |
| T3-011 | LOCKED | Local taxes use representative/median estimates with major/high-impact exceptions; exact municipality identification is not required unless specifically supported. |
| T3-012 | LOCKED | Use the phrase “Estimated Local Withholding” unless exact local rules are known. |
| T3-013 | LOCKED | No local tax is represented as 0%. |
| T3-014 | LOCKED | Flat occupational/service taxes remain distinguishable from percentage-based income taxes. |
| T3-015 | LOCKED | Tax engine is universal and versioned; historical calculations must remain reproducible. |
| T3-016 | LOCKED | Government sites are not called during every calculation. Calculations use a local verified copy of applicable rules. |
| T3-017 | LOCKED | Tax source retrieval/verification is periodic and separate from runtime calculation. |
| T3-018 | LOCKED | State tax source configurations are data-driven rather than implemented as dozens of unrelated hard-coded functions. |
| T3-019 | LOCKED | Social Security and Medicare are automatically estimated. |
| T3-020 | LOCKED | FICA calculations must account for tax-year rates, wage base, Medicare, Additional Medicare threshold, and applicable pre-tax treatment. |
| T3-021 | LOCKED | Paycheck Check should use actual paycheck information entered by the user to improve future paycheck estimates. |
| T3-022 | LOCKED | Where the necessary values are available, the application should calculate the observed withholding percentage from actual paycheck amounts using the appropriate taxable-wage basis, not merely gross pay. |
| T3-023 | LOCKED | The application should preserve enough information to explain how an observed withholding percentage was calculated and which basis was used. |
| T3-024 | LOCKED | Observed withholding percentages are estimates and not necessarily official tax rates or guarantees of future withholding. |
| T3-025 | LOCKED | The application should use the user's observed withholding information to estimate taxes on future paychecks while preserving historical observations and the percentage used for each estimate. |
| T3-026 | LOCKED | The application must not silently replace historical calculation assumptions when a newer pay stub produces a different percentage. |
| T3-027 | UNRESOLVED | The method for choosing or averaging historical observed withholding percentages is an unresolved design decision until the owner approves it. |
| T3-028 | LOCKED | Applicable tax categories remain distinct for estimation and comparison, including federal income tax, state income tax, local income tax, Social Security, Medicare, Additional Medicare, and other supported taxes. |
| T3-029 | LOCKED | The architecture should use the simplest maintainable approach that meets the requirements without assuming every tax category behaves identically or can safely be estimated with the same percentage of gross pay. |
| T3-030 | LOCKED | The application should show, for each supported tax category, the estimated withholding amount, the percentage or basis used for the estimate, the actual withholding amount entered from the pay stub, the actual observed percentage when the necessary basis is available, the dollar difference, and the percentage-point difference where appropriate. |
| T3-031 | LOCKED | Tax estimate explanations must distinguish observed withholding percentages from official statutory tax rates and should use neutral language. |

## Tax Estimation Detail and Observed Withholding

| ID | Status | Requirement |
|---|---|---|
| TAX-007 | LOCKED | Tax rule data remains distinct from tax calculation results. The rule table stores jurisdiction, tax year, effective dates, rule version, source/reference, and verification metadata, while calculation results store estimated amounts and the rule version used for a paycheck. |
| TAX-008 | LOCKED | The application should preserve the historical observations and percentage used for each estimate so that prior calculations remain explainable and reproducible. |
| TAX-009 | UNRESOLVED | The exact method for selecting, weighting, or averaging historical observed withholding percentages must be approved before implementation. |
| TAX-010 | LOCKED | Do not create a separate database table for every tax concept without a concrete justification; the model should remain maintainable and not over-fragment tax rules. |
| TAX-011 | LOCKED | Do not build a large local-tax-rate database merely to support personalized withholding estimates if observed paycheck information can satisfy the requirement. |
| TAX-012 | LOCKED | Aggregate withholding percentage analysis is permitted only when it complies with the application's privacy and minimum-population requirements and does not expose an individual user's paycheck amounts or observed percentages in aggregate reporting. |

## Actual Tier 3 fields

- Federal income tax
- State income tax
- Local income tax
- Social Security
- Medicare
- Additional Medicare where applicable
- Other taxes shown on the paycheck

Qualified overtime:
- Qualified OT is an estimate and not a guaranteed tax saving.
- 2026 W-2 Box 12 Code TT is an annual comparison input for employer-reported qualified overtime.
- Compare accumulated estimated qualified overtime with W-2 TT when applicable.

# 14. Tax Data Architecture

| ID | Status | Requirement |
|---|---|---|
| TAX-001 | LOCKED | Tax rules are date-aware and versioned. |
| TAX-002 | LOCKED | Tax rules remain distinguishable by jurisdiction and tax type. |
| TAX-003 | LOCKED | Historical calculations must remain reproducible using the rule version applicable at the time. |
| TAX-004 | LOCKED | Federal, state, county, municipality, work location, residence location, and other applicable tax concepts must remain distinguishable where rules differ. |
| TAX-005 | LOCKED | User-provided local tax figures are reference estimates, not authoritative statutory data. They must not be presented as verified law without research. |
| TAX-006 | LOCKED | Commercial tax APIs may be considered only as optional validation/backup; they are not required core architecture and cannot be added without approval. |

## User-provided local-tax reference estimates

These are planning/reference values supplied by the owner and must be independently verified before being presented as authoritative tax rules:

- PA earned income: typical 1–2%; Philadelphia: 3.735% resident / 3.425% nonresident.
- OH municipal: typical 1.5–2.5%; Youngstown 2.75%; Columbus/Cleveland/Akron/Toledo/Dayton 2.5%.
- IN county: 1–2.5%; Marion/Indianapolis approximately 2.02%.
- MD county/Baltimore City: 2.8–3.2%; Dorchester/Kent 3.30%; Baltimore City 3.20%.
- MI city: 1.0%/0.5%; Detroit 2.4%/1.2%.
- NY NYC: 3.078–3.876%.
- KY occupational: 1.5–2.2%; Covington approximately 2.45%; Louisville 2.2%/1.45%.
- MO city earnings: 1%.
- AL occupational: 1–2%; Birmingham/Bessemer 1%; Gadsden 2%.
- DE Wilmington: 1.25%.
- OR: high earners up to approximately 4% combined in Portland metro, 0 under approximately $125k.
- CO: flat occupational privilege fee; Denver $5.75/month employee.
- WV: flat city service fees.
- NJ: 0 employee local.
- IA: limited local/school low.

# 15. Actual Pay and Comparison

| ID | Status | Requirement |
|---|---|---|
| ACT-001 | LOCKED | Actual Pay page first displays the Paycheck Check estimate. |
| ACT-002 | LOCKED | Example Tier 1 estimate may display Estimated Gross $2,000. |
| ACT-003 | LOCKED | Provide Compare Actual Pay action. |
| ACT-004 | LOCKED | Comparison may use a modal or separate page, subject to architecture review. |
| ACT-005 | LOCKED | Submit returns to the comparison page with actual values shown beneath estimates. |
| ACT-006 | LOCKED | Actual values are editable and savable. |
| ACT-007 | LOCKED | Actual less than estimate = red text. |
| ACT-008 | LOCKED | Actual greater than estimate = green text. |
| ACT-009 | LOCKED | Equal actual and estimate = yellow text. |
| ACT-010 | LOCKED | Difference is shown inside a yellow border. |
| ACT-011 | LOCKED | Blank actual values are not treated as zero and produce no difference. |
| ACT-012 | LOCKED | Placeholder values may match the estimate but must remain visually distinct from entered actual values. |
| ACT-013 | LOCKED | Comparison is field-by-field: Hours → Pay → Gross → Taxes/Deductions → Net. |
| ACT-014 | LOCKED | Never infer fault from a comparison difference. |

# 15.5 Results Page Presentation

| ID | Status | Requirement |
|---|---|---|
| RES-001 | LOCKED | The first thing a user sees on a paycheck calculation or comparison page should be a concise summary of the most important results, including gross pay, estimated taxes, estimated deductions, estimated net pay, actual net pay when entered, and the estimate-versus-actual difference when available. |
| RES-002 | LOCKED | The summary must not show actual values that have not been entered as though they were zero and must not invent a result when required inputs are unavailable. |
| RES-003 | LOCKED | After the quick summary, provide a detailed breakdown that explains how the paycheck figures were calculated. |
| RES-004 | LOCKED | For each applicable category, use this sequence: estimate, actual pay-stub value or input area, and difference between the estimate and actual value. |
| RES-005 | LOCKED | The actual-value input should appear directly below the corresponding estimate, and the difference should appear directly below the actual value. |
| RES-006 | LOCKED | Detailed explanations should include the relevant inputs, pay rates, observed percentages, taxable wage basis, and calculation steps where applicable. |
| RES-007 | LOCKED | For percentage-based deductions, the explanation should include the percentage, the compensation basis, and the resulting dollar amount. |
| RES-008 | LOCKED | For tax estimates, the explanation must distinguish observed withholding percentages from official statutory tax rates. |
| RES-009 | LOCKED | The results page should remain readable and mobile-first, with clear headings, spacing, and predictable layout. |
| RES-010 | LOCKED | Relevant tax and qualified-overtime limitations must remain visible on detailed calculation pages and must not exist only on an About page. |
| RES-011 | LOCKED | The results page should explain the inputs and arithmetic used to produce the estimate without overwhelming the user with unnecessary technical detail. |

# 16. Reporting, Retention, and Annual History

| ID | Status | Requirement |
|---|---|---|
| REP-001 | LOCKED | Full detailed data is retained until scheduled cleanup. |
| REP-002 | LOCKED | Cleanup occurs every June 1. |
| REP-003 | LOCKED | On June 1 of year X, detailed records from year X−2 are deleted. |
| REP-004 | LOCKED | Example: 2025 detail is deleted June 1, 2027; 2026 detail is deleted June 1, 2028. |
| REP-005 | LOCKED | Account creation date does not affect the cleanup schedule. |
| REP-006 | LOCKED | Before detailed records are deleted, the complete annual/YTD summary for that year is calculated and persisted. |
| REP-007 | LOCKED | Permanent annual history is one yearly summary record/concept per applicable year, not a monthly archive. |
| REP-008 | LOCKED | Permanent annual summary contains yearly totals only and no monthly breakdown. |
| REP-009 | LOCKED | Annual summary includes total gross, regular pay, OT pay, qualified OT, total hours, OT hours, federal withholding, state withholding, local withholding, Social Security, Medicare, other taxes, total deductions, net pay, estimated totals, actual totals, total estimate-vs-actual difference, job-level annual totals, and other established annual metrics. |
| REP-010 | LOCKED | User Profile includes yearly summaries. |
| REP-011 | LOCKED | Monthly reports are available while detailed data exists. |
| REP-012 | LOCKED | Current year vs previous year can be shown side-by-side. |
| REP-013 | LOCKED | Monthly report format is PDF only. |
| REP-014 | LOCKED | No full-year PDF. |
| REP-015 | LOCKED | No YTD PDF. |
| REP-016 | LOCKED | MTD means current calendar month through today. |
| REP-017 | LOCKED | No arbitrary date-range PDFs. |
| REP-018 | PROPOSED | Exact annual-summary creation/idempotency mechanism is an architecture decision, provided it preserves the locked June 1 safety behavior. |

# 16.5. Admin Operational Errors and Usage Analytics

| ID | Status | Requirement |
|---|---|---|
| ADMIN-001 | LOCKED | Admin Dashboard must track total user count, account creation date, last logged-in information, approximate session/activity duration where available, general geographic area, and error counts/resolution status. |
| ADMIN-002 | LOCKED | Geographic analytics may use only general/approximate country, state, or city areas; do not collect or display GPS coordinates or precise device-location tracking. |
| ADMIN-003 | LOCKED | Use a lightweight session/activity mechanism rather than collecting every click or detailed behavioral event. |
| ADMIN-004 | LOCKED | Reuse the existing technical error-log system for technical errors; do not create a parallel technical logging system. |
| ADMIN-005 | LOCKED | Provide a separate database table for Admin-actionable errors with at minimum id, title, date, resolved boolean, note, and nullable date_resolved. |
| ADMIN-006 | LOCKED | Admin can view unresolved actionable errors, edit/add notes, resolve errors, and reopen them. Resolving sets date_resolved; reopening clears it. |
| ADMIN-007 | LOCKED | Annual cleanup failures must create an actionable Admin error identifying the affected stage (summary creation or detail deletion), affected year/records, and affected user information as appropriate, while preserving detailed data when required by the cleanup safety rules. |
| ADMIN-008 | LOCKED | Annual cleanup success creates no actionable Admin error. |
| ADMIN-009 | LOCKED | Leaflet JS is approved for geographic mapping; reuse the existing Leaflet setup where practical and do not add another mapping library. |

# 17. SEO

| ID | Status | Requirement |
|---|---|---|
| SEO-001 | LOCKED | Public-facing pages should be strongly SEO-conscious. |
| SEO-002 | LOCKED | Private/authenticated pages should not be SEO-targeted and should be appropriately excluded from indexing. |
| SEO-003 | LOCKED | Before implementation, research current first-party guidance from Google Search Central and Microsoft Bing Webmaster documentation, plus other relevant first-party search documentation where useful. |
| SEO-004 | LOCKED | Research should cover crawlability/indexing, robots.txt, XML sitemap, canonical URLs, titles, meta descriptions, headings, structured data, mobile usability, Core Web Vitals/performance, Open Graph/social metadata, duplicate/thin content, and authenticated/private page noindex behavior. |
| SEO-005 | LOCKED | SEO research must distinguish actual requirements/constraints from recommended practices and optional optimizations. |
| SEO-006 | LOCKED | Do not implement SEO changes until the research/specification has been reviewed and approved. |

# 18. UI / UX

| ID | Status | Requirement |
|---|---|---|
| UI-001 | LOCKED | Mobile-first design. |
| UI-002 | LOCKED | Use large, clear controls for time entry and comparison workflows. |
| UI-003 | LOCKED | Calculation limitations should appear near detailed results, not only on a general About page. |
| UI-004 | LOCKED | User-facing language should be clear, neutral, and non-accusatory. |

# 19. Testing

| ID | Status | Requirement |
|---|---|---|
| TEST-001 | LOCKED | Business rules must have automated tests. |
| TEST-002 | LOCKED | Test regular hours, overtime hours, overtime calculations, and work weeks crossing pay-period boundaries. |
| TEST-003 | LOCKED | Test paycheck calculations, taxes, deductions, qualified overtime calculations where applicable, validation, and historical tax-rule behavior. |
| TEST-004 | LOCKED | Tests should verify behavior rather than implementation details. |
| TEST-005 | LOCKED | Do not change tests merely to make a failing implementation pass. Determine whether the implementation or requirement/test is wrong; ask the owner if unclear. |

# 20. Genuine Unresolved Items

These are the currently known unresolved owner decisions. Do not manufacture additional questions merely to appear thorough. Implementation recommendations are not owner requirements until approved.

| ID | Status | Decision Needed |
|---|---|---|
| UNRES-003 | UNRESOLVED | Any genuinely necessary edge-case calculation rules discovered during final end-to-end consistency review. |
| UNRES-005 | UNRESOLVED | Exact implementation of the additional secure quick-login option after architecture review verifies what Laravel 13, Fortify, installed Passkeys support, Vite/React, and browser/platform APIs can provide without third-party dependencies. The three supported-choice requirement, traditional password fallback, optional Passkeys, no custom PIN, no browser-stored password/PIN, one active trusted device, and revocation/replacement are already LOCKED. |

# 21. Important Historical Corrections

The following are explicitly settled and must not be reintroduced as open questions:

- There is **no Request Correction workflow**.
- There is **no closed-period unlock workflow**.
- Pay schedules are weekly, biweekly, or semimonthly.
- Work weeks and pay periods are separate.
- Multiple jobs are independent for paycheck calculations.
- Time is recorded with actual timestamps.
- Tier 1 Actual Net Pay is optional personal tracking only.
- AI recommendations are not requirements until approved.
- Traditional email + password remains a supported authentication method.
- Passkeys are optional; they are not mandatory.
- The custom PIN quick-login concept is removed.
- A separate secure quick-login option may be used only if the architecture review validates a native/existing-stack implementation.
- Only one trusted/remembered quick-login device may be active at a time; registering a new one invalidates the previous one.
- User-approved requirements take precedence over AI suggestions.

# 22. Architecture Review Expectations

Before implementation, the AI must:

1. Read this ledger.
2. Inspect the actual repository and installed application.
3. Use Laravel Boost MCP for Laravel-specific guidance where relevant.
4. Verify installed versions/packages rather than relying on memory.
5. Inspect existing schema, routes, authentication, frontend structure, tests, and reusable code.
6. Identify contradictions between the actual application and this ledger.
7. Propose the domain model and database model.
8. Explain how calculations, tax rules, historical versions, retention, and authorization should be structured.
9. Identify only genuine unresolved decisions.
10. Wait for owner approval before substantial implementation.

No code should be written during the architecture-review stage.
