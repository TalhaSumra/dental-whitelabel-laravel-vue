<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({ agency: Object });
const page = usePage();

const brand = props.agency?.agency_name || 'Dental Growth Media';

const img = (id, w = 600) => `https://images.unsplash.com/${id}?w=${w}&q=75&auto=format&fit=crop`;
const photos = [
    'photo-1588776814546-1ffcf47267a5',
    'photo-1606811841689-23dfddce3e95',
    'photo-1629909613654-28e377c37b09',
    'photo-1609840114035-3c981b782dfe',
    'photo-1612277795421-9bc7706a4a34',
    'photo-1571772996211-2f02c9727629',
];

const nav = [
    { label: 'About us', href: '#who' },
    { label: 'Services', href: '#solutions', caret: true },
    { label: 'Systems', href: '#systems' },
    { label: 'Process', href: '#process' },
    { label: 'Impact', href: '#impact' },
    { label: 'Contact Us', href: '#contact' },
];

const stats = [
    { to: 50, suffix: '+', label: 'Active Clinics' },
    { to: 12, suffix: 'x', label: 'Avg. ROI' },
    { to: 6, suffix: '+', label: 'Years Operating' },
    { to: 96, suffix: '%', label: 'Client Retention' },
];

const packages = [
    { name: 'Scout', blurb: 'Perfect for clinics starting to build their online presence', features: ['Custom Website', 'Mobile-Responsive', 'Local SEO Setup', 'Google Business Profile', '2 Blog Articles/mo'] },
    { name: 'Ranger', blurb: 'Ideal for practices ready to scale growth and automate patient intake', features: ['Everything in Scout', '50 Backlinks', 'New-Patient Forms', 'Online Booking', 'E-Signatures', 'AI-Driven SEO'] },
    { name: 'Guardian', blurb: 'Comprehensive digital presence with Google Ads management', features: ['Everything in Ranger', '100 Backlinks', 'Google Ads', 'Print Collateral', 'Posters & Flyers'] },
    { name: 'Alpha', blurb: 'Best for balancing strong digital growth with local presence', features: ['Everything in Ranger', '120 HQ Backlinks', 'Social Media Mgmt', 'Meta Ads', 'Content Creation', 'Print Collateral'], popular: true },
    { name: 'Titan', blurb: 'Full-service solution to outperform competitors with maximum visibility', features: ['Everything in Ranger', '150 Authority Backlinks', 'Full Social Mgmt', 'Meta Ads Campaigns', 'Google Ads', 'Premium Print'] },
    { name: 'Add-ons', blurb: 'Enhance any plan with premium services and one-time upgrades', features: ['Videography', 'Photoshoot', 'Premium Hosting', 'Patient Newsletters', 'Social Ads Add-on', 'Google Ads Add-on'] },
];

const tools = [
    { name: 'Google Ads', letter: 'A', color: '#4285F4' },
    { name: 'Search Console', letter: 'S', color: '#34A853' },
    { name: 'Analytics 4', letter: 'GA', color: '#E37400' },
    { name: 'Looker Studio', letter: 'L', color: '#4285F4' },
    { name: 'Semrush', letter: 'Se', color: '#FF642D' },
    { name: 'Ahrefs', letter: 'Ah', color: '#0F6CBD' },
    { name: 'Meta Ads', letter: 'M', color: '#0866FF' },
    { name: 'Figma', letter: 'Fi', color: '#A259FF' },
    { name: 'Canva', letter: 'C', color: '#00C4CC' },
    { name: 'WordPress', letter: 'W', color: '#21759B' },
    { name: 'Tag Manager', letter: 'TM', color: '#246FDB' },
    { name: 'Hotjar', letter: 'H', color: '#FF3C00' },
];

const process = [
    { code: 'PRC_01', title: 'Discovery & Positioning', time: '1-2 weeks', desc: 'We map your local market, competitors, and patient demand. Define your unique position and growth levers.', deliverables: ['Market analysis', 'Competitor audit', 'Positioning', 'Patient personas', 'Value proposition'], tools: ['Semrush', 'Ahrefs', 'Analytics', 'Hotjar'] },
    { code: 'PRC_02', title: 'Brand & Creative System', time: '2-3 weeks', desc: 'Establish visual identity, messaging framework, and brand guidelines that scale across every channel.', deliverables: ['Brand guidelines', 'Logo & assets', 'Color & type', 'Voice & tone', 'Social templates'], tools: ['Figma', 'Adobe CC', 'Canva Pro', 'Notion'] },
    { code: 'PRC_03', title: 'Website Build / Optimization', time: '4-6 weeks', desc: 'Design and develop a conversion-optimized dental website built for performance, SEO, and patient booking.', deliverables: ['Site architecture', 'UI/UX design', 'Development', 'Speed optimization', 'Booking flow'], tools: ['WordPress', 'Webflow', 'PageSpeed', 'GTM'] },
    { code: 'PRC_04', title: 'Social Media Execution', time: 'Ongoing', desc: 'Launch a strategic local social presence with consistent content, engagement, and community building.', deliverables: ['Content calendar', 'Post creation', 'Community mgmt', 'Social analytics', 'Engagement playbook'], tools: ['Buffer', 'Later', 'Canva', 'Meta Suite'] },
    { code: 'PRC_05', title: 'Google Ads Behind the Scenes', time: '1-2 weeks setup', desc: 'Set up data-driven paid campaigns with proper tracking, testing frameworks, and optimization protocols.', deliverables: ['Campaign setup', 'Conversion tracking', 'Ad creative', 'Bid strategies', 'Audience targeting'], tools: ['Google Ads', 'GTM', 'Analytics 4', 'Looker Studio'] },
    { code: 'PRC_06', title: 'SEO Compounding Growth', time: 'Ongoing', desc: 'Implement technical SEO, content strategy, and link building for sustainable organic patient growth.', deliverables: ['Technical audit', 'Content plan', 'On-page SEO', 'Link building', 'Keyword research'], tools: ['Semrush', 'Ahrefs', 'Screaming Frog', 'Search Console'] },
    { code: 'PRC_07', title: 'Reporting & Scaling', time: 'Monthly', desc: 'Transparent analytics, performance reviews, and strategic iteration to compound results over time.', deliverables: ['Monthly reports', 'Dashboards', 'Growth roadmap', 'Optimization plan', 'ROI analysis'], tools: ['Looker Studio', 'Analytics', 'Custom dashboards', 'Slack'] },
];

const systems = [
    { code: 'SYS_01', title: 'Brand Infrastructure', desc: 'The visual, messaging, and content systems that make your clinic recognizable and scalable.', items: [{ label: 'Compliance + Claims Guardrails', status: 'Enforced' }, { label: 'Brand Voice + Messaging Standards', status: 'Documented' }, { label: 'Content & Creative Template Library', status: 'Ready' }, { label: 'Patient Intake & Access Setup', status: 'Standardized' }] },
    { code: 'SYS_02', title: 'Patient Acquisition Engine', desc: 'Strategic ad campaigns + SEO + social working together to generate qualified patients at scale.', items: [{ label: 'Google Ads Build + Optimization', status: 'Active' }, { label: 'SEO Content Production Pipeline', status: 'Running' }, { label: 'Social Media Production + Scheduling', status: 'Live' }, { label: 'Landing Pages + Conversion Support', status: 'Optimizing' }] },
    { code: 'SYS_03', title: 'Performance Loop', desc: 'Continuous measurement, reporting, and optimization that compounds results month over month.', items: [{ label: 'Tracking + Attribution', status: 'Monitoring' }, { label: 'Reporting + Action Items', status: 'Automated' }, { label: 'Testing Queue (Ads + Pages + Creative)', status: 'Running' }, { label: 'Monthly Strategy Review + Reallocation', status: 'Scheduled' }] },
];

const clinics = [
    { name: 'Maple Family Dental', city: 'Toronto', img: photos[0] },
    { name: 'Harbourview Dental', city: 'Vancouver', img: photos[1] },
    { name: 'Bow River Dental', city: 'Calgary', img: photos[2] },
    { name: 'Rideau Smiles', city: 'Ottawa', img: photos[3] },
    { name: 'Prairie Dental Co.', city: 'Winnipeg', img: photos[4] },
    { name: 'Lakeshore Dental Studio', city: 'Mississauga', img: photos[5] },
    { name: 'Centre-Ville Dentaire', city: 'Montreal', img: photos[1] },
    { name: 'Northern Lights Dental', city: 'Edmonton', img: photos[2] },
    { name: 'Bayfront Dental Care', city: 'Halifax', img: photos[0] },
    { name: 'Capital Dental Group', city: 'Victoria', img: photos[3] },
];

const cases = [
    { code: 'CASE_01', title: 'Emergency Dental Clinic', problem: 'Spending heavily with a previous agency and plateauing at a low volume of new-patient calls each month.', action: 'Rebuilt and optimized the acquisition system to improve call volume and quality while reducing monthly spend.', result: 'Within 3 months, more than doubled qualified new-patient calls at roughly half the previous ad budget.', tags: ['Google Ads'] },
    { code: 'CASE_02', title: 'Family Dental Practice', problem: 'Social content was generic (office photos + vague captions), driving minimal local growth year over year.', action: 'Shifted to local, area-based content within a 5-10 km radius, adding educational posts and timely updates.', result: 'Now generating hundreds of organic local followers per year and tens of thousands of monthly impressions.', tags: ['Social Media'] },
    { code: 'CASE_03', title: 'Cosmetic & Implant Studio', problem: 'Stable but not growing, with no active marketing and few new patients arriving organically each month.', action: 'Built a complete growth system: new website, Google Ads with audit, active social, and optimized intake flows.', result: 'After 8 months on a modest monthly budget, more than doubled new patients compared to the prior year.', tags: ['Website', 'SEO', 'Google Ads', 'Backlinks', 'Social Media'] },
];

const form = useForm({ clinic_name: '', contact_name: '', email: '', phone: '', city: '', province: '', message: '' });
const sent = ref(false);

function submit() {
    form.post('/audit-request', {
        preserveScroll: true,
        onSuccess: () => { form.reset(); sent.value = true; },
    });
}

const isDark = ref(true);
const scrolled = ref(false);
function onScroll() { scrolled.value = window.scrollY > 24; }

function toggleTheme() {
    isDark.value = !isDark.value;
    const root = document.documentElement;
    root.classList.toggle('dark', isDark.value);
    try { localStorage.setItem('theme', isDark.value ? 'dark' : 'light'); } catch (e) {}
}

onMounted(() => {
    isDark.value = document.documentElement.classList.contains('dark');
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
});
onUnmounted(() => window.removeEventListener('scroll', onScroll));

const vReveal = {
    mounted(el, binding) {
        el.classList.add('reveal');
        if (binding.value) el.style.transitionDelay = `${binding.value}ms`;
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) { el.classList.add('in'); io.unobserve(el); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        io.observe(el);
    },
};

const vCount = {
    mounted(el, binding) {
        const to = binding.value.to;
        const suffix = binding.value.suffix || '';
        el.textContent = `0${suffix}`;
        let done = false;
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting && !done) {
                    done = true;
                    io.unobserve(el);
                    const dur = 1500;
                    const start = performance.now();
                    const step = (now) => {
                        const p = Math.min(1, (now - start) / dur);
                        const eased = 1 - Math.pow(1 - p, 3);
                        el.textContent = `${Math.round(to * eased)}${suffix}`;
                        if (p < 1) requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                }
            });
        }, { threshold: 0.4 });
        io.observe(el);
    },
};
</script>

<template>
    <div id="top" class="min-h-screen bg-slate-50 font-display text-slate-600 antialiased transition-colors duration-300 dark:bg-[#080a12] dark:text-slate-300 selection:bg-teal-400/30">
        <!-- ambient glows -->
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div class="dg-float-1 absolute -top-40 left-1/2 h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-teal-300/30 blur-[120px] dark:bg-teal-500/10"></div>
            <div class="dg-float-2 absolute top-1/3 -right-40 h-[32rem] w-[32rem] rounded-full bg-emerald-300/25 blur-[120px] dark:bg-emerald-500/10"></div>
            <div class="dg-float-1 absolute bottom-0 -left-40 h-[32rem] w-[32rem] rounded-full bg-cyan-300/25 blur-[120px] dark:bg-cyan-500/10"></div>
        </div>

        <!-- NAV -->
        <header class="fixed inset-x-0 top-4 z-50 px-4">
            <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 rounded-full border px-4 py-3 backdrop-blur-xl transition-all duration-300"
                 :class="scrolled
                    ? 'border-slate-200 bg-white/90 shadow-lg dark:border-white/10 dark:bg-[#0b0d16]/85'
                    : 'border-slate-200/70 bg-white/70 shadow-md dark:border-white/10 dark:bg-white/[0.04]'">
                <a href="#top" class="flex items-center gap-2.5 pl-1">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-teal-400 to-emerald-500 shadow-lg shadow-teal-500/30">
                        <svg class="h-5 w-5 text-[#06231f]" viewBox="0 0 24 24" fill="currentColor"><path d="M7.5 3C5 3 3 5 3 7.8c0 1.8.5 3 .9 4.7.3 1.3.4 2.7.6 4 .2 1.6.5 3.5 1.7 3.5 1 0 1.2-1.4 1.4-2.7.2-1.1.3-2.3 1.1-2.3.7 0 .9.9 1.1 2 .2 1.4.5 3 1.6 3 1.3 0 1.6-2.1 1.8-3.8.2-1.3.3-2.6.6-3.9.4-1.6.9-2.8.9-4.5C16.9 5 14.9 3 12.4 3c-1.1 0-1.7.5-2.4.5S8.6 3 7.5 3Z"/></svg>
                    </span>
                    <span class="text-sm font-bold tracking-tight text-slate-900 dark:text-white">{{ brand }}</span>
                </a>
                <div class="hidden items-center gap-0.5 lg:flex">
                    <a v-for="item in nav" :key="item.href" :href="item.href"
                       class="flex items-center gap-1 rounded-full px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-900/5 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/5 dark:hover:text-white">
                        {{ item.label }}
                        <svg v-if="item.caret" class="h-3 w-3 opacity-60" viewBox="0 0 12 12" fill="none"><path d="M3 4.5 6 7.5 9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" @click="toggleTheme" aria-label="Toggle theme"
                            class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:text-teal-600 dark:border-white/10 dark:text-slate-300 dark:hover:text-teal-300">
                        <svg v-if="isDark" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" stroke-linecap="round"/></svg>
                        <svg v-else class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <a href="#contact"
                       class="rounded-full bg-gradient-to-r from-teal-400 to-emerald-500 px-5 py-2 text-sm font-semibold text-[#06231f] shadow-[0_0_24px_rgba(45,212,191,0.45)] transition hover:scale-105 hover:shadow-[0_0_36px_rgba(45,212,191,0.7)]">
                        Let's Talk
                    </a>
                </div>
            </nav>
        </header>

        <main class="relative z-10">
            <!-- HERO -->
            <section class="relative mx-auto max-w-5xl px-6 pb-24 pt-44 text-center sm:pt-52">
                <div class="dg-bob absolute left-2 top-44 hidden rounded-2xl border border-slate-200 bg-white/80 p-4 text-left shadow-xl backdrop-blur-md dark:border-white/10 dark:bg-white/[0.05] lg:block" v-reveal="200">
                    <p class="font-mono text-[10px] uppercase tracking-widest text-slate-400">New patients</p>
                    <p class="mt-1 text-2xl font-bold text-teal-500 dark:text-teal-300">+127%</p>
                </div>
                <div class="dg-bob-slow absolute right-2 top-60 hidden rounded-2xl border border-slate-200 bg-white/80 p-4 text-left shadow-xl backdrop-blur-md dark:border-white/10 dark:bg-white/[0.05] lg:block" v-reveal="350">
                    <p class="font-mono text-[10px] uppercase tracking-widest text-slate-400">Calls / mo</p>
                    <p class="mt-1 text-2xl font-bold text-emerald-500 dark:text-emerald-300">300+</p>
                    <div class="mt-1 flex gap-0.5 text-amber-400">★★★★★</div>
                </div>

                <h1 class="font-display text-5xl font-bold leading-[1.05] tracking-tight text-slate-900 dark:text-white sm:text-7xl" v-reveal>
                    Built like a system,
                    <span class="animate-gradient block bg-gradient-to-r from-teal-500 via-emerald-500 to-cyan-500 bg-clip-text text-transparent dark:from-teal-300 dark:via-teal-400 dark:to-cyan-400">by geography, by demand,</span>
                    <span class="animate-gradient block bg-gradient-to-r from-emerald-500 to-teal-500 bg-clip-text text-transparent dark:from-emerald-400 dark:to-teal-300">by design.</span>
                </h1>
                <p class="mx-auto mt-8 max-w-2xl text-lg text-slate-500 dark:text-slate-400" v-reveal="120">
                    We build patient-generating growth systems for Canadian dental clinics that keep working long after launch.
                </p>
                <div class="mt-10 flex flex-wrap items-center justify-center gap-4" v-reveal="220">
                    <a href="#contact" class="rounded-xl bg-gradient-to-r from-teal-400 to-emerald-500 px-8 py-4 text-base font-semibold text-[#06231f] shadow-[0_0_30px_rgba(45,212,191,0.45)] transition hover:scale-105 hover:shadow-[0_0_44px_rgba(45,212,191,0.7)]">
                        Get a free audit
                    </a>
                    <a href="#solutions" class="rounded-xl border border-slate-300 px-8 py-4 text-base font-semibold text-slate-700 transition hover:border-teal-400 hover:text-teal-600 dark:border-white/15 dark:text-slate-200 dark:hover:border-teal-400/60 dark:hover:text-teal-300">
                        See packages
                    </a>
                </div>
                <p class="mt-12 font-mono text-xs uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500" v-reveal>Trusted by Canadian dental clinics</p>
                <div class="mt-10 flex flex-col items-center gap-2 text-slate-400 dark:text-slate-600">
                    <span class="font-mono text-[11px] uppercase tracking-[0.3em]">Scroll to discover</span>
                    <svg class="h-4 w-4 animate-bounce text-teal-500 dark:text-teal-400" viewBox="0 0 16 16" fill="none"><path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </section>

            <!-- CERTIFIED -->
            <section class="mx-auto max-w-6xl px-6 py-16">
                <div class="mx-auto flex max-w-md flex-col items-center rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm dark:border-white/10 dark:bg-white/[0.03]" v-reveal>
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-md ring-1 ring-slate-100 dark:ring-0">
                        <svg class="h-8 w-8" viewBox="0 0 24 24"><path fill="#4285F4" d="M22 12.2c0-.7-.1-1.4-.2-2H12v3.9h5.6a4.8 4.8 0 0 1-2 3.2v2.6h3.3c1.9-1.8 3-4.4 3-7.7Z"/><path fill="#34A853" d="M12 22c2.7 0 5-1 6.6-2.5l-3.3-2.6c-.9.6-2 1-3.3 1a5.8 5.8 0 0 1-5.4-4H3.2v2.6A10 10 0 0 0 12 22Z"/><path fill="#FBBC05" d="M6.6 13.9a5.9 5.9 0 0 1 0-3.8V7.5H3.2a10 10 0 0 0 0 9z"/><path fill="#EA4335" d="M12 6.1c1.5 0 2.8.5 3.8 1.5l2.9-2.9A10 10 0 0 0 3.2 7.5l3.4 2.6A5.8 5.8 0 0 1 12 6.1Z"/></svg>
                    </div>
                    <p class="mt-5 font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400">Certified Excellence</p>
                    <h3 class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">Google Partner Agency</h3>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">A certified Google Partner, recognized for expertise in Google Ads and a commitment to delivering measurable results for dental practices across Canada.</p>
                </div>
            </section>

            <!-- WHO -->
            <section id="who" class="mx-auto max-w-6xl scroll-mt-28 px-6 py-24">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="relative" v-reveal>
                        <img :src="img(photos[2], 800)" alt="Modern dental clinic" loading="lazy"
                             class="aspect-[4/3] w-full rounded-3xl border border-slate-200 object-cover shadow-xl dark:border-white/10" />
                        <div class="dg-bob absolute -bottom-6 -right-4 rounded-2xl border border-slate-200 bg-white/90 p-4 shadow-xl backdrop-blur dark:border-white/10 dark:bg-[#0b0d16]/90">
                            <p class="font-mono text-[10px] uppercase tracking-widest text-slate-400">Avg. ROI</p>
                            <p class="text-2xl font-bold text-teal-500 dark:text-teal-300">8-12x</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>WHO_01</p>
                        <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-5xl" v-reveal="80">Who We Are</h2>
                        <p class="mt-6 text-lg text-slate-600 dark:text-slate-400" v-reveal="140">
                            We are <span class="font-semibold text-teal-600 dark:text-teal-300">{{ brand }}</span>, a growth-engineering firm specializing in digital ecosystems for dentistry. We build patient-demand machines that scale acquisition for Canadian clinics.
                        </p>
                        <p class="mt-4 text-slate-500 dark:text-slate-500" v-reveal="200">
                            We don't wing it. We engineer repeatable systems, measure everything, and scale what works. Our clients don't just get campaigns — they get a complete growth infrastructure: brand systems, conversion-optimized websites, multi-channel execution, and transparent analytics.
                        </p>
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-px overflow-hidden rounded-3xl border border-slate-200 bg-slate-200 dark:border-white/10 dark:bg-white/[0.06] lg:grid-cols-4">
                    <div v-for="(s, i) in stats" :key="s.label" class="relative bg-white p-8 dark:bg-[#0b0d16]" v-reveal="i * 90">
                        <span class="absolute right-4 top-4 font-mono text-[11px] text-slate-300 dark:text-slate-600">0{{ i + 1 }}</span>
                        <p v-count="{ to: s.to, suffix: s.suffix }" class="bg-gradient-to-r from-teal-500 to-emerald-500 bg-clip-text text-4xl font-bold text-transparent dark:from-teal-300 dark:to-emerald-400"></p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ s.label }}</p>
                    </div>
                </div>
            </section>

            <!-- SOLUTIONS -->
            <section id="solutions" class="mx-auto max-w-6xl scroll-mt-28 px-6 py-24">
                <div class="text-center">
                    <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>SOLUTIONS_02</p>
                    <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-6xl" v-reveal="80">What We Build</h2>
                    <p class="mt-6 text-lg text-slate-500 dark:text-slate-400" v-reveal="140">Modular, scalable solutions engineered for measurable growth</p>
                </div>
                <div class="mt-16 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div v-for="(pkg, i) in packages" :key="pkg.name" v-reveal="(i % 3) * 100"
                         class="group relative flex flex-col rounded-2xl border bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:shadow-xl dark:bg-white/[0.03] dark:shadow-none"
                         :class="pkg.popular ? 'border-teal-400/60 shadow-[0_0_40px_rgba(45,212,191,0.15)]' : 'border-slate-200 hover:border-teal-400/50 dark:border-white/10 dark:hover:border-teal-400/30'">
                        <span v-if="pkg.popular" class="absolute -top-3 left-7 rounded-full bg-gradient-to-r from-teal-400 to-emerald-500 px-3 py-1 font-mono text-[10px] uppercase tracking-widest text-[#06231f]">Popular</span>
                        <div class="flex items-start justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-teal-400/30 bg-teal-400/10 text-teal-600 transition group-hover:scale-110 dark:text-teal-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2 4 6v6c0 5 3.5 8 8 10 4.5-2 8-5 8-10V6l-8-4Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="font-mono text-xs text-slate-300 dark:text-slate-600">0{{ i + 1 }}</span>
                        </div>
                        <h3 class="mt-5 text-xl font-bold text-slate-900 dark:text-white">{{ pkg.name }}</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ pkg.blurb }}</p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            <span v-for="f in pkg.features" :key="f" class="rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1 font-mono text-[11px] text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">{{ f }}</span>
                        </div>
                        <a href="#contact" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal-600 transition group-hover:gap-3 dark:text-teal-300">
                            Discover
                            <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>
                <div class="mt-12 text-center" v-reveal>
                    <a href="#contact" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-teal-400 to-emerald-500 px-7 py-3.5 text-sm font-semibold text-[#06231f] shadow-[0_0_30px_rgba(45,212,191,0.4)] transition hover:scale-105 hover:shadow-[0_0_44px_rgba(45,212,191,0.65)]">
                        Explore More
                        <svg class="h-4 w-4" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <p class="mt-20 text-center font-mono text-xs uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500" v-reveal>Tools that assist us</p>
                <div class="marquee mt-8">
                    <div class="marquee-track gap-4">
                        <div v-for="(t, i) in [...tools, ...tools]" :key="i" class="flex w-32 shrink-0 flex-col items-center gap-2">
                            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-lg font-bold shadow-md ring-1 ring-slate-100 dark:ring-white/10" :style="{ color: t.color }">{{ t.letter }}</span>
                            <span class="font-mono text-[11px] text-slate-500 dark:text-slate-400">{{ t.name }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROCESS -->
            <section id="process" class="mx-auto max-w-6xl scroll-mt-28 px-6 py-24">
                <div class="text-center">
                    <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>PROCESS_03</p>
                    <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-6xl" v-reveal="80">Our 7-Stage Process</h2>
                    <p class="mt-6 text-lg text-slate-500 dark:text-slate-400" v-reveal="140">A repeatable, engineered workflow that turns insights into outcomes</p>
                </div>
                <div class="mt-16 grid gap-6 md:grid-cols-2">
                    <div v-for="(step, i) in process" :key="step.code" v-reveal="(i % 2) * 90"
                         class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-teal-400/50 hover:shadow-lg dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none dark:hover:border-teal-400/30">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs uppercase tracking-[0.2em] text-teal-500 dark:text-teal-400">{{ step.code }}</span>
                            <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 font-mono text-[11px] text-slate-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-400">{{ step.time }}</span>
                        </div>
                        <h3 class="mt-4 text-xl font-bold text-slate-900 dark:text-white">{{ step.title }}</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ step.desc }}</p>
                        <p class="mt-5 font-mono text-[11px] uppercase tracking-widest text-slate-400 dark:text-slate-500">Deliverables</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span v-for="d in step.deliverables" :key="d" class="rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1 font-mono text-[11px] text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">{{ d }}</span>
                        </div>
                        <p class="mt-4 font-mono text-[11px] uppercase tracking-widest text-slate-400 dark:text-slate-500">Tools used</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span v-for="t in step.tools" :key="t" class="rounded-md border border-teal-400/30 bg-teal-400/10 px-2.5 py-1 font-mono text-[11px] text-teal-600 dark:border-teal-400/20 dark:bg-teal-400/5 dark:text-teal-300/80">{{ t }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SYSTEMS -->
            <section id="systems" class="mx-auto max-w-6xl scroll-mt-28 px-6 py-24">
                <div class="text-center">
                    <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>SYSTEMS_04</p>
                    <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-6xl" v-reveal="80">How We Operate</h2>
                    <p class="mt-6 text-lg text-slate-500 dark:text-slate-400" v-reveal="140">Three interconnected systems power repeatable, measurable growth.</p>
                </div>
                <div class="mt-16 grid gap-6 lg:grid-cols-3">
                    <div v-for="(sys, i) in systems" :key="sys.code" v-reveal="i * 110"
                         class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ sys.title }}</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ sys.desc }}</p>
                        <div class="mt-6 space-y-3">
                            <div v-for="item in sys.items" :key="item.label" class="rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-teal-400/40 dark:border-white/10 dark:bg-[#0b0d16]">
                                <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ item.label }}</p>
                                <p class="mt-1 flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-teal-600 dark:text-teal-400">
                                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-teal-500 dark:bg-teal-400"></span>{{ item.status }}
                                </p>
                            </div>
                        </div>
                        <span class="mt-6 block text-right font-mono text-xs text-slate-300 dark:text-slate-600">{{ sys.code }}</span>
                    </div>
                </div>
            </section>

            <!-- CLIENTS / IMPACT -->
            <section id="impact" class="scroll-mt-28 py-24">
                <div class="mx-auto max-w-6xl px-6 text-center">
                    <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>CLIENTS_05</p>
                    <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-6xl" v-reveal="80">Who We Serve</h2>
                    <p class="mt-6 text-lg text-slate-500 dark:text-slate-400" v-reveal="140">Trusted by forward-thinking dental clinics across Canada.</p>
                </div>

                <div class="marquee mt-16">
                    <div class="marquee-track gap-5 px-3">
                        <div v-for="(c, i) in [...clinics, ...clinics]" :key="i"
                             class="group w-80 shrink-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-white/10 dark:bg-white/[0.03]">
                            <div class="relative h-40 overflow-hidden bg-gradient-to-br from-teal-400/20 to-emerald-400/20">
                                <img :src="img(c.img, 500)" :alt="c.name" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                <span class="absolute right-3 top-3 rounded-full bg-black/40 px-2 py-1 font-mono text-[10px] uppercase tracking-widest text-white backdrop-blur">Clinic</span>
                            </div>
                            <div class="flex items-center justify-between p-5">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ c.name }}</p>
                                    <p class="text-sm text-slate-500">{{ c.city }}</p>
                                </div>
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-teal-600 dark:text-teal-300">explore
                                    <svg class="h-3 w-3" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-auto mt-20 max-w-6xl px-6">
                    <div class="text-center">
                        <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400" v-reveal>Case Studies</p>
                        <h3 class="mt-3 font-display text-3xl font-bold text-slate-900 dark:text-white" v-reveal="80">Before &amp; After</h3>
                    </div>
                    <div class="mt-12 grid gap-6 lg:grid-cols-3">
                        <div v-for="(cs, i) in cases" :key="cs.code" v-reveal="i * 110"
                             class="flex flex-col rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none">
                            <span class="font-mono text-xs uppercase tracking-[0.2em] text-teal-500 dark:text-teal-400">{{ cs.code }}</span>
                            <h4 class="mt-3 text-xl font-bold text-slate-900 dark:text-white">{{ cs.title }}</h4>
                            <div class="mt-5 space-y-4 text-sm">
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-rose-500/80 dark:text-rose-400/80">Problem</p>
                                    <p class="mt-1 text-slate-500 dark:text-slate-400">{{ cs.problem }}</p>
                                </div>
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-amber-500/90 dark:text-amber-400/80">Action</p>
                                    <p class="mt-1 text-slate-500 dark:text-slate-400">{{ cs.action }}</p>
                                </div>
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-teal-600 dark:text-teal-400">Result</p>
                                    <p class="mt-1 text-slate-700 dark:text-slate-300">{{ cs.result }}</p>
                                </div>
                            </div>
                            <div class="mt-5 flex flex-wrap gap-2">
                                <span v-for="t in cs.tags" :key="t" class="rounded-md border border-teal-400/30 bg-teal-400/10 px-2.5 py-1 font-mono text-[11px] text-teal-600 dark:border-teal-400/20 dark:bg-teal-400/5 dark:text-teal-300/80">{{ t }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CONTACT -->
            <section id="contact" class="mx-auto max-w-6xl scroll-mt-28 px-6 py-24">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-start">
                    <div v-reveal>
                        <p class="font-mono text-xs uppercase tracking-[0.3em] text-teal-500 dark:text-teal-400">CONTACT_06</p>
                        <h2 class="mt-4 font-display text-4xl font-bold text-slate-900 dark:text-white sm:text-5xl">Get in Touch</h2>
                        <p class="mt-6 text-lg text-slate-500 dark:text-slate-400">Ready to engineer your clinic's growth? Let's start the conversation.</p>
                        <div class="mt-10 space-y-5">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-teal-400/30 bg-teal-400/10 text-teal-600 dark:text-teal-300">@</span>
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-slate-400 dark:text-slate-500">Email</p>
                                    <p class="text-sm text-slate-800 dark:text-slate-200">{{ agency?.support_email || 'hello@dentalgrowth.local' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-teal-400/30 bg-teal-400/10 text-teal-600 dark:text-teal-300">⌖</span>
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-widest text-slate-400 dark:text-slate-500">Location</p>
                                    <p class="text-sm text-slate-800 dark:text-slate-200">Canada</p>
                                </div>
                            </div>
                            <p class="font-mono text-xs text-teal-600/90 dark:text-teal-400/80">→ Average response time: Under 24 hours</p>
                        </div>
                    </div>

                    <form class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none" @submit.prevent="submit" v-reveal="100">
                        <div v-if="sent || page.props.flash?.success" class="mb-6 rounded-xl border border-teal-400/40 bg-teal-400/10 px-4 py-3 text-sm text-teal-700 dark:text-teal-200">
                            {{ page.props.flash?.success || 'Your audit request was received. We will contact you shortly.' }}
                        </div>
                        <div class="space-y-5">
                            <div>
                                <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Clinic name *</label>
                                <input v-model="form.clinic_name" required placeholder="Your clinic" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                <p v-if="form.errors.clinic_name" class="mt-1 text-xs text-rose-500">{{ form.errors.clinic_name }}</p>
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Your name *</label>
                                    <input v-model="form.contact_name" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                    <p v-if="form.errors.contact_name" class="mt-1 text-xs text-rose-500">{{ form.errors.contact_name }}</p>
                                </div>
                                <div>
                                    <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Email *</label>
                                    <input v-model="form.email" type="email" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                    <p v-if="form.errors.email" class="mt-1 text-xs text-rose-500">{{ form.errors.email }}</p>
                                </div>
                            </div>
                            <div class="grid gap-5 sm:grid-cols-3">
                                <div>
                                    <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Phone</label>
                                    <input v-model="form.phone" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                </div>
                                <div>
                                    <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">City</label>
                                    <input v-model="form.city" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                </div>
                                <div>
                                    <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Province</label>
                                    <input v-model="form.province" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20" />
                                </div>
                            </div>
                            <div>
                                <label class="font-mono text-[11px] uppercase tracking-widest text-slate-500 dark:text-slate-400">Message</label>
                                <textarea v-model="form.message" rows="4" placeholder="Website, SEO, Google rankings, ads, more patients..." class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-600 dark:focus:border-teal-400/60 dark:focus:ring-teal-400/20"></textarea>
                            </div>
                            <button type="submit" :disabled="form.processing" class="w-full rounded-xl bg-gradient-to-r from-teal-400 to-emerald-500 px-6 py-4 text-sm font-semibold text-[#06231f] shadow-[0_0_30px_rgba(45,212,191,0.4)] transition hover:scale-[1.02] hover:shadow-[0_0_44px_rgba(45,212,191,0.65)] disabled:opacity-60">
                                {{ form.processing ? 'Sending...' : 'Send Message' }}
                            </button>
                            <p class="text-center text-xs text-slate-400 dark:text-slate-600">We do not promise guaranteed rankings or fake reviews. All marketing content is approved by your clinic before publishing.</p>
                        </div>
                    </form>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="border-t border-slate-200 px-6 py-16 dark:border-white/10">
                <div class="mx-auto grid max-w-6xl gap-12 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-teal-400 to-emerald-500 shadow-lg shadow-teal-500/30">
                                <svg class="h-5 w-5 text-[#06231f]" viewBox="0 0 24 24" fill="currentColor"><path d="M7.5 3C5 3 3 5 3 7.8c0 1.8.5 3 .9 4.7.3 1.3.4 2.7.6 4 .2 1.6.5 3.5 1.7 3.5 1 0 1.2-1.4 1.4-2.7.2-1.1.3-2.3 1.1-2.3.7 0 .9.9 1.1 2 .2 1.4.5 3 1.6 3 1.3 0 1.6-2.1 1.8-3.8.2-1.3.3-2.6.6-3.9.4-1.6.9-2.8.9-4.5C16.9 5 14.9 3 12.4 3c-1.1 0-1.7.5-2.4.5S8.6 3 7.5 3Z"/></svg>
                            </span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ brand }}</span>
                        </div>
                        <p class="mt-4 max-w-xs text-sm text-slate-500">Your trusted dental marketing partner. Helping Canadian clinics grow with data-driven digital marketing strategies.</p>
                    </div>
                    <div>
                        <p class="font-mono text-xs uppercase tracking-widest text-slate-400 dark:text-slate-500">Quick Links</p>
                        <ul class="mt-4 space-y-3 text-sm text-slate-500 dark:text-slate-400">
                            <li><a href="#top" class="transition hover:text-teal-600 dark:hover:text-teal-300">Home</a></li>
                            <li><a href="#who" class="transition hover:text-teal-600 dark:hover:text-teal-300">About Us</a></li>
                            <li><a href="#solutions" class="transition hover:text-teal-600 dark:hover:text-teal-300">Services</a></li>
                            <li><a href="#contact" class="transition hover:text-teal-600 dark:hover:text-teal-300">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-mono text-xs uppercase tracking-widest text-slate-400 dark:text-slate-500">Our Services</p>
                        <ul class="mt-4 space-y-3 text-sm text-slate-500 dark:text-slate-400">
                            <li>Brand Development</li>
                            <li>Website Design</li>
                            <li>Local SEO</li>
                            <li>Content Marketing</li>
                            <li>Social Media</li>
                            <li>Google Ads / PPC</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-mono text-xs uppercase tracking-widest text-slate-400 dark:text-slate-500">Contact Us</p>
                        <ul class="mt-4 space-y-3 text-sm text-slate-500 dark:text-slate-400">
                            <li>{{ agency?.support_email || 'hello@dentalgrowth.local' }}</li>
                            <li>Canada</li>
                        </ul>
                    </div>
                </div>
                <div class="mx-auto mt-12 flex max-w-6xl flex-col items-center justify-between gap-4 border-t border-slate-200 pt-8 text-sm text-slate-400 dark:border-white/10 dark:text-slate-600 sm:flex-row">
                    <p>© {{ new Date().getFullYear() }} {{ brand }}. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="transition hover:text-slate-700 dark:hover:text-slate-300">Privacy Policy</a>
                        <a href="#" class="transition hover:text-slate-700 dark:hover:text-slate-300">Disclaimer</a>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</template>
