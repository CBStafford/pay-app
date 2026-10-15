# Paycheck Check — Copilot Architecture Review Prompt

You are performing an **architecture and requirements review only** for the Laravel application `pay-app` (user-facing name: **Paycheck Check**).

## Critical rule

**Do not write application code yet.**

Do not create or modify:
- migrations
- models
- controllers
- services
- actions
- policies
- routes
- React pages/components
- forms
- tests
- configuration
- third-party packages
- database records

Do not install packages.

The purpose of this task is to inspect the existing application and produce an architecture review that the owner can approve before implementation begins.

Before starting a task, read the requirements ledger and the current implementation status. Use the ledger as the source of truth for locked decisions and for the next unfinished task. Inspect only the code and tests relevant to the current task. Reuse existing working functionality instead of re-reviewing or rebuilding completed features without a concrete reason. Revisit completed functionality only when an approved change affects it or a relevant test fails. Investigate test failures before changing code. Update the ledger's implementation status as work is completed. Do not invent requirements or silently resolve owner decisions. Do not install third-party packages without explicit permission. Do not modify application code before required design approvals are in place.

---

## Source of truth

First read the authoritative requirements ledger:

```text
/docs/paycheck-check/requirements-ledger.md
```

If the file is not present at that exact path, stop and report that the repository is missing the required source-of-truth file rather than guessing its contents. The owner should place the ledger in the repository at `/docs/paycheck-check/requirements-ledger.md` before running this review.

Also read, if present:

```text
/docs/paycheck-check/seo-research-prompt.md
```

Treat the ledger as the current requirements source of truth.

Requirement status rules:

- **LOCKED** = authoritative. Do not reinterpret or re-open it.
- **PROPOSED** = recommendation only.
- **UNRESOLVED** = requires a decision if implementation depends on it.

Do not re-ask questions that the ledger already settles.

Do not invent missing requirements.

If the repository contains behavior that conflicts with a LOCKED requirement, identify the conflict rather than silently changing either one.

---

## Required Laravel/AI development rules

1. Use **Laravel Boost MCP** and its Laravel-specific documentation/guidance whenever relevant.
2. Inspect the actual installed Laravel/application version before relying on an API.
3. Inspect the actual installed Composer/npm packages and versions.
4. Do not rely on remembered Laravel APIs.
5. Do not add or recommend a third-party package as though it were approved.
6. Prefer existing Laravel functionality and packages already installed.
7. Reuse existing project conventions and working code where appropriate.
8. Do not perform unrelated refactoring.
9. Keep business calculations out of React presentation components.
10. Clearly separate:
   - facts found in the repository,
   - LOCKED requirements,
   - proposed architecture,
   - unresolved decisions,
   - risks/dependencies.
11. Treat user-facing accuracy and responsibility language as product behavior requirements, not as optional copy.
12. Do not imply that historical observations validate payroll correctness or tax withholding merely because a new estimate closely matches prior pay periods.
13. Accuracy notices must be included in onboarding, paycheck comparison pages, and annual summary pages, with the more detailed explanation available on an About/Help/methodology page if needed.
14. The application must communicate that estimates depend on the accuracy of user-provided information and that users remain responsible for reviewing discrepancies and consulting payroll/tax professionals when necessary.

---

# Review Tasks

## 1. Inspect the current application

Use Laravel Boost and the repository to establish the actual current state.

Inspect at minimum:

- Laravel version
- PHP version
- Composer packages
- npm packages
- database driver/version where discoverable
- migrations/schema
- existing models and relationships
- authentication/Fortify configuration
- authorization/policies
- routes
- controllers/actions/services
- Inertia configuration
- React structure
- TypeScript/JavaScript conventions
- Tailwind/frontend conventions
- existing reusable UI components
- tests and testing conventions
- scheduled jobs/commands if present
- logging/error handling
- existing security/privacy mechanisms
- existing documentation
- existing SEO/public-page infrastructure if present
- existing PWA/manifest/service-worker infrastructure if present
- existing passkey/WebAuthn and trusted-device/authentication infrastructure if present

Do not modify anything.

## 2. Identify reusable existing functionality

Identify existing code that can support Paycheck Check.

For each relevant item, state:

- file/path
- what it currently does
- how it could be reused
- whether reuse requires modification
- whether the proposed reuse creates any dependency or risk

Do not rewrite working functionality merely because another approach is possible.

## 3. Review the domain model

Propose a domain model that preserves the distinctions required by the ledger, especially:

- User
- Job
- historical job settings/rates
- Pay Schedule
- Pay Period
- Work Week
- Time Entry
- Holiday/PTO/work dimensions
- overtime calculation/result
- premium pay
- qualified overtime compensation
- paycheck estimate
- actual paycheck values
- deductions
- deduction schedules/frequency
- tax rules and versions
- tax calculation results
- annual summary
- retention/cleanup

Do not assume every concept requires its own database table.

Explain where a concept should be:
- an entity/table,
- a value object/domain concept,
- a calculated result,
- a configuration record,
- or a versioned reference.

## 4. Propose the database model

Provide a proposed schema at the conceptual level.

For each proposed table/entity, describe:

- purpose
- important fields
- primary key strategy
- foreign keys
- ownership boundary
- relevant indexes
- effective-date/versioning needs
- retention behavior
- historical-data requirements

Pay particular attention to:

### Work weeks vs pay periods

A work week must remain independent from a pay period.

The design must correctly calculate overtime when a work week crosses a pay-period boundary.

Do not design a solution that simply calculates overtime from the dates contained in one pay period.

### Historical rates/settings

Historical calculations must remain reproducible.

### Tax rules

Tax rules must be versioned/date-aware so historical calculations can use the applicable rule version.

### Annual retention

On June 1 of year X:
1. calculate and persist the complete annual summary for year X−2;
2. only then delete detailed data for year X−2.

The annual summary is permanent and contains yearly totals, not monthly detail.

The cleanup process must be safe to retry without creating duplicate annual summaries or deleting data before the summary is safely persisted.

The exact implementation/idempotency mechanism is a proposal for review, not an invented requirement.

## 5. Calculation architecture

Propose how the application should calculate:

- worked hours
- regular hours
- daily overtime
- weekly overtime
- premium pay
- regular pay
- overtime pay
- qualified overtime compensation
- gross pay
- deductions
- withholding
- estimated net pay
- estimate-vs-actual differences

Explicitly explain how daily and weekly overtime avoid double counting.

Explicitly explain how cross-pay-period work weeks are handled.

Keep calculation logic testable and independent from React UI.

Do not invent tax formulas that are not established by authoritative sources.

## 6. Tax architecture

Propose the architecture for a universal, versioned tax engine.

Address:

- federal withholding
- state withholding
- local withholding
- Social Security
- Medicare
- Additional Medicare
- other taxes shown on a paycheck
- tax-year versions
- effective dates
- jurisdiction
- work location vs residence location
- representative local estimates
- authoritative source data
- periodic source verification
- reproducibility of historical calculations

Do not invent tax rates.

Do not recommend calling government websites during every paycheck calculation.

The runtime calculation should use a verified local representation of applicable rules.

## 7. Deductions

Review the locked Tier 2 deduction requirements.

Address:

- deduction types
- dollar vs percentage behavior
- frequency
- extra-paycheck handling
- historical changes
- estimate vs actual comparison
- whether the proposed data model supports both individual and combined deductions

Do not introduce a generic amount/percentage selector because the requirements already define which deduction types use which representation.

## 8. Actual Pay comparison

Review the estimate-vs-actual workflow.

Confirm that:

- blank actual values are not zero;
- differences are only calculated when actual data exists;
- field-by-field comparison is possible;
- actual net pay remains optional in Tier 1;
- no fault is inferred from differences.

Recommend the cleanest server/domain representation for this comparison without changing the requirements.

## 9. Privacy, authorization, PWA, and quick authentication

Review the current authentication/data-isolation architecture against:

- minimal PII
- encrypted email plus deterministic keyed `email_lookup_hash`
- strong user isolation
- historical data isolation
- sensitive data logging restrictions

Also review the current Laravel 13 + Fortify + installed Passkeys + Inertia React/Vite/browser capabilities for the locked PWA and quick-authentication requirements.

The owner has explicitly removed the custom PIN concept. Do not propose a custom Paycheck Check PIN or browser-stored password/PIN mechanism. Do not store passwords, PINs, or equivalent authentication secrets literally in browser storage.

The required authentication model has three choices: (1) traditional email + password, which must remain a permanent fallback; (2) an optional Passkey option; and (3) an additional secure quick-login option if the existing Laravel/browser capabilities can provide one without a new dependency. Passkeys are not mandatory. If multiple secure options are technically supportable, the user should be allowed to choose.

Determine, using the actual installed stack and current authoritative documentation, what can safely be offered without adding a third-party package. In particular, evaluate:

- existing Laravel/Fortify Passkeys/WebAuthn support
- browser/platform-native credential capabilities
- whether a server-authoritative trusted-device credential can safely provide the additional quick-login experience using existing Laravel authentication/session mechanisms and browser APIs
- how one active trusted/remembered quick-login device per user can be enforced
- how registering a new trusted device invalidates the previous device
- how the previous device falls back to email + password
- how Profile/Security can revoke and replace the active credential
- how sensitive account changes receive password/strong step-up authentication
- what the PWA itself requires versus what authentication requires
- current PWA manifest/installability/secure-context requirements
- whether a service worker is actually necessary and, if used, what it should and should not cache

Do not implement authentication or PWA functionality during this review. Report the viable choices, security implications, reuse of existing functionality, limitations, and recommended architecture for owner approval.

Do not implement authentication or PWA functionality during this review. Report the viable choices, security implications, reuse of existing functionality, and recommended architecture for owner approval.

Identify conflicts with the current Fortify starter and explain what must be resolved before implementation.

## 10. Retention and scheduled processing

Review the June 1 cleanup requirement.

Propose:

- where the annual summary should be generated;
- how the cleanup should be scheduled;
- transaction/idempotency strategy;
- failure/retry behavior;
- ordering of summary creation vs deletion;
- how to ensure no detailed data is deleted without a corresponding permanent annual summary.

Do not implement it yet.

## 11. Testing strategy

Propose tests for behavior, including:

- regular hours
- multiple time entries per day
- overnight entries
- incomplete entries
- holiday worked
- holiday paid-not-worked
- PTO
- daily overtime
- weekly overtime
- daily + weekly overtime without double counting
- work weeks crossing pay-period boundaries
- pay-period calculations
- rate-history behavior
- deductions and frequency
- extra paycheck deduction behavior
- federal/state/local withholding
- historical tax-rule versions
- qualified overtime
- estimate-vs-actual comparisons
- authorization/user isolation
- annual-summary generation
- June 1 retention cleanup and retry/idempotency
- validation

Use the repository's existing Pest/testing conventions.

## 12. SEO research

Do not implement SEO yet.

Use the separate SEO research prompt:

```text
/docs/paycheck-check/seo-research-prompt.md
```

If that file exists, follow it.

The architecture review should summarize how SEO affects the application architecture, especially:

- public vs authenticated pages
- indexability
- sitemap/robots infrastructure
- canonical URLs
- metadata
- structured data
- performance
- private-page noindex behavior

Do not add packages.

---

# Required Output

Return an architecture review with these sections:

1. **Current Application Architecture**
2. **Installed Stack and Versions**
3. **Existing Code We Can Reuse**
4. **Requirements/Repository Conflicts**
5. **Proposed Domain Model**
6. **Proposed Database Model**
7. **Calculation Architecture**
8. **Tax Architecture**
9. **Deduction Architecture**
10. **Actual Pay Comparison Architecture**
11. **Privacy and Authorization**
12. **Retention and Annual Summary**
13. **Testing Strategy**
14. **SEO Architecture Considerations**
15. **Implementation Sequence**
16. **Dependencies and Risks**
17. **Genuine Unresolved Decisions**
18. **Readiness Assessment**

For the readiness assessment, explicitly state:

- what is ready for implementation;
- what is blocked;
- which decisions require owner approval;
- which items are merely implementation recommendations.

## Important

Do not write code.

Do not modify files.

Do not install packages.

Do not silently resolve an unresolved requirement.

Wait for the owner's approval before implementation.
