# Supabase production configuration

The portfolio uses Supabase PostgreSQL for application data and the
`portfolio-media` Storage bucket for uploaded images.

Add these environment variables in **Vercel → Project Settings → Environment
Variables** for Production, Preview, and Development as appropriate:

```text
DB_CONNECTION=pgsql
DB_URL=<Supabase pooled PostgreSQL connection string>
DB_SSLMODE=require
SUPABASE_URL=https://nfgxjwfmvumcqajyrjsp.supabase.co
SUPABASE_SERVICE_ROLE_KEY=<Supabase service_role secret>
```

Get `DB_URL` from Supabase **Connect** using the pooled connection string.
Get `SUPABASE_SERVICE_ROLE_KEY` from **Project Settings → API Keys**. It must
only be added to Vercel/server environments; never expose it in browser code.

After the variables are saved, redeploy the latest `main` branch. The database
schema and the public `portfolio-media` bucket have already been created.
