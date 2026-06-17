# Deploying to Render (free)

This repo is ready to deploy as a Docker web service on [Render](https://render.com).
It uses SQLite, so no separate database is required (data resets on each cold start —
fine for a demo/preview).

## One-time steps

1. Go to **https://render.com** and click **Get Started** → **Sign in with GitHub**.
2. Authorize Render to access this repository (`dental-whitelabel-laravel-vue`).
3. In the Render dashboard click **New +** → **Blueprint**.
4. Select this repository. Render reads [`render.yaml`](render.yaml) and configures a
   free Docker web service automatically. Click **Apply** / **Create**.
5. Wait for the first build (~3–6 min). When it finishes you get a public URL like
   `https://dental-whitelabel.onrender.com` — send that to your client.

If you prefer not to use the Blueprint: **New +** → **Web Service** → pick the repo →
Render auto-detects the `Dockerfile`. Set instance type **Free**, leave the start
command empty (the image has an entrypoint), and deploy.

## Notes

- The free instance sleeps after ~15 min idle; the first request after that takes
  ~50 seconds to wake. Subsequent requests are fast.
- `APP_KEY` is generated automatically on boot (see `docker/entrypoint.sh`).
- Seeded logins (change before real use): `admin@dentalgrowth.local` /
  `client@example.com`, password `Password123!`.
- To use a persistent database later, add a Render PostgreSQL instance and set the
  `DB_*` environment variables in the service settings.
