/**
 * Portfolio Interactive System
 * - Web Audio API Synthesizer (Optional Sound FX, Off by default)
 * - Interactive Desktop Cursor & Radial Spotlight
 * - Magnetic Buttons & Micro-Interactions
 * - 3D Perspective Card Tilt & Specular Sheen
 * - Viewport Scroll Reveal & Stagger
 * - Dual-Curtain Transition Hook & Navbar Replay
 */

document.addEventListener('DOMContentLoaded', () => {
    initAudioEngine();
    initCustomCursor();
    initMagneticElements();
    initCardTilt();
    initScrollReveal();
    initNavbar();
    initMobileMenu();
    initActiveNavLink();
    initWelcomeScreenTriggers();
});

/* ==========================================================================
   1. WEB AUDIO API ENGINE (Clean UI Sound FX - Clicks & Chimes)
   ========================================================================== */
let audioCtx = null;
let masterGain = null;
let lastClickTime = 0;
let soundEnabled = localStorage.getItem('portfolio_audio_enabled') === 'true';

/** Lazy-initialize a single singleton AudioContext with Master Bus */
function getAudioContext() {
    if (!audioCtx && (window.AudioContext || window.webkitAudioContext)) {
        const AudioClass = window.AudioContext || window.webkitAudioContext;
        audioCtx = new AudioClass();

        // Master Gain Node connected directly to destination
        masterGain = audioCtx.createGain();
        masterGain.gain.setValueAtTime(soundEnabled ? 1 : 0, audioCtx.currentTime);
        masterGain.connect(audioCtx.destination);
    }

    if (audioCtx && audioCtx.state === 'suspended') {
        audioCtx.resume();
    }
    return audioCtx;
}

let lastHoverTime = 0;
let lastHoverTarget = null;

const portfolioAudio = {
    /** Delicate Tactile Hover Pop: Extremely soft wooden tick, premium and clean */
    playHover(target) {
        if (!soundEnabled) return;
        const ctx = getAudioContext();
        if (!ctx || !masterGain) return;

        const now = ctx.currentTime;
        // Avoid duplicate triggers on child elements within the same container
        if (target && target === lastHoverTarget && (now - lastHoverTime < 0.2)) return;
        // Throttle rapid hovering to keep it clean (minimum 40ms interval)
        if (now - lastHoverTime < 0.04) return;

        lastHoverTime = now;
        lastHoverTarget = target;

        try {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            const filter = ctx.createBiquadFilter();

            // Bandpass / Lowpass filter for smooth organic warmth
            filter.type = 'lowpass';
            filter.frequency.setValueAtTime(1800, now);

            osc.type = 'sine';
            // Pure delicate blip (640Hz dropping smoothly to 480Hz)
            osc.frequency.setValueAtTime(640, now);
            osc.frequency.exponentialRampToValueAtTime(480, now + 0.022);

            // Very low volume, fast 18ms micro-decay
            gain.gain.setValueAtTime(0, now);
            gain.gain.linearRampToValueAtTime(0.016, now + 0.002);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.02);

            osc.connect(filter);
            filter.connect(gain);
            gain.connect(masterGain);

            osc.start(now);
            osc.stop(now + 0.022);

            osc.onended = () => {
                osc.disconnect();
                filter.disconnect();
                gain.disconnect();
            };
        } catch (_) {}
    },

    /** Clean Subtle UI Click Sound: Organic, tactile mechanical pop without buzzing or distortion */
    playClick() {
        if (!soundEnabled) return;
        const ctx = getAudioContext();
        if (!ctx || !masterGain) return;

        // Debounce: prevent overlapping clicks within 60ms
        const now = ctx.currentTime;
        if (now - lastClickTime < 0.06) return;
        lastClickTime = now;

        try {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            const filter = ctx.createBiquadFilter();

            // Low-pass filter to ensure pure warm warmth without harsh treble
            filter.type = 'lowpass';
            filter.frequency.setValueAtTime(1400, now);

            osc.type = 'sine';
            // Subtle pitch drop from 520Hz down to 280Hz
            osc.frequency.setValueAtTime(520, now);
            osc.frequency.exponentialRampToValueAtTime(280, now + 0.038);

            // Fast micro-envelope: 3ms attack, 35ms exponential decay
            gain.gain.setValueAtTime(0, now);
            gain.gain.linearRampToValueAtTime(0.04, now + 0.003);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.038);

            osc.connect(filter);
            filter.connect(gain);
            gain.connect(masterGain);

            osc.start(now);
            osc.stop(now + 0.042);

            osc.onended = () => {
                osc.disconnect();
                filter.disconnect();
                gain.disconnect();
            };
        } catch (_) {}
    },

    /** Subtle Curtain Opening Chime: Gentle ethereal bell triad */
    playCurtain() {
        if (!soundEnabled) return;
        const ctx = getAudioContext();
        if (!ctx || !masterGain) return;

        try {
            const now = ctx.currentTime;
            // Pentatonic triad [330Hz (E4), 440Hz (A4), 554.37Hz (C#5)]
            [330, 440, 554.37].forEach((freq, idx) => {
                const startTime = now + (idx * 0.04);
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();

                osc.type = 'sine';
                osc.frequency.setValueAtTime(freq, startTime);

                // Ethereal chime envelope: soft attack, 0.5s ring-out
                gain.gain.setValueAtTime(0, startTime);
                gain.gain.linearRampToValueAtTime(0.02, startTime + 0.025);
                gain.gain.exponentialRampToValueAtTime(0.0001, startTime + 0.55);

                osc.connect(gain);
                gain.connect(masterGain);

                osc.start(startTime);
                osc.stop(startTime + 0.58);

                osc.onended = () => {
                    osc.disconnect();
                    gain.disconnect();
                };
            });
        } catch (_) {}
    }
};
window.portfolioAudio = portfolioAudio;

function initAudioEngine() {
    const soundToggle = document.getElementById('sound-toggle-btn');
    const soundText = document.getElementById('sound-toggle-label');

    const updateSoundUI = () => {
        if (!soundToggle) return;
        if (soundEnabled) {
            soundToggle.classList.add('sound-active', 'text-[#467C78]');
            soundToggle.classList.remove('text-[#1D2A35]/60');
            soundToggle.setAttribute('title', 'Sound FX: ON (Klik untuk mematikan)');
            if (soundText) soundText.textContent = 'SFX: ON';
        } else {
            soundToggle.classList.remove('sound-active', 'text-[#467C78]');
            soundToggle.classList.add('text-[#1D2A35]/60');
            soundToggle.setAttribute('title', 'Sound FX: OFF (Klik untuk mengaktifkan)');
            if (soundText) soundText.textContent = 'SFX: OFF';
        }
    };

    updateSoundUI();

    if (soundToggle) {
        soundToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            soundEnabled = !soundEnabled;
            localStorage.setItem('portfolio_audio_enabled', soundEnabled ? 'true' : 'false');

            const ctx = getAudioContext();
            if (ctx && masterGain) {
                const now = ctx.currentTime;
                if (soundEnabled) {
                    masterGain.gain.cancelScheduledValues(now);
                    masterGain.gain.setValueAtTime(1, now);
                    portfolioAudio.playClick();
                } else {
                    masterGain.gain.cancelScheduledValues(now);
                    masterGain.gain.setValueAtTime(0, now);
                }
            }

            updateSoundUI();
        });
    }

    // Attach click sound listener to interactive links and buttons
    document.addEventListener('click', (e) => {
        if (e.target.closest('#sound-toggle-btn')) return;

        const target = e.target.closest('a, button, [role="button"]');
        if (target && !target.hasAttribute('disabled') && soundEnabled) {
            portfolioAudio.playClick();
        }
    }, { passive: true });
}

/* ==========================================================================
   2. INTERACTIVE DESKTOP CURSOR & SPOTLIGHT
   ========================================================================== */
function initCustomCursor() {
    // Only on fine-pointer devices (mouse/trackpad), never on touch screens
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;

    // Check prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    let dot = document.getElementById('cursor-dot');
    let ring = document.getElementById('cursor-ring');
    let spotlight = document.getElementById('cursor-spotlight');

    // Create cursor elements dynamically if not already in DOM
    if (!dot) {
        dot = document.createElement('div');
        dot.id = 'cursor-dot';
        dot.className = 'cursor-dot';
        document.body.appendChild(dot);
    }
    if (!ring) {
        ring = document.createElement('div');
        ring.id = 'cursor-ring';
        ring.className = 'cursor-ring';
        document.body.appendChild(ring);
    }
    if (!spotlight) {
        spotlight = document.createElement('div');
        spotlight.id = 'cursor-spotlight';
        spotlight.className = 'cursor-spotlight';
        document.body.appendChild(spotlight);
    }

    let mouseX = -100, mouseY = -100;
    let ringX = -100, ringY = -100;
    let isMoving = false;

    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        if (!isMoving) {
            isMoving = true;
            dot.style.opacity = '1';
            ring.style.opacity = '1';
            spotlight.style.opacity = '1';
        }

        dot.style.transform = `translate(${mouseX}px, ${mouseY}px) translate(-50%, -50%)`;
        spotlight.style.background = `radial-gradient(600px circle at ${mouseX}px ${mouseY}px, rgba(70, 124, 120, 0.055), transparent 70%)`;
    }, { passive: true });

    window.addEventListener('mouseleave', () => {
        dot.style.opacity = '0';
        ring.style.opacity = '0';
        spotlight.style.opacity = '0';
        isMoving = false;
    });

    window.addEventListener('mousedown', () => {
        ring.classList.add('cursor-active');
    });

    window.addEventListener('mouseup', () => {
        ring.classList.remove('cursor-active');
    });

    // Smooth lerp loop for the outer ring
    function renderRing() {
        ringX += (mouseX - ringX) * 0.18;
        ringY += (mouseY - ringY) * 0.18;
        ring.style.transform = `translate(${ringX}px, ${ringY}px) translate(-50%, -50%)`;
        requestAnimationFrame(renderRing);
    }
    requestAnimationFrame(renderRing);

    // Hover detection on interactive elements
    const interactiveSelectors = 'a, button, input, textarea, select, [role="button"], .editorial-card, .editorial-card-dark, [data-magnetic]';
    document.addEventListener('mouseover', (e) => {
        const target = e.target.closest(interactiveSelectors);
        if (target) {
            ring.classList.add('cursor-hover');
            portfolioAudio.playHover(target);
        }
    }, { passive: true });

    document.addEventListener('mouseout', (e) => {
        if (e.target.closest(interactiveSelectors)) {
            ring.classList.remove('cursor-hover');
        }
    }, { passive: true });
}

/* ==========================================================================
   3. MAGNETIC BUTTONS & CTA MICRO-INTERACTIONS
   ========================================================================== */
function initMagneticElements() {
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const magnetics = document.querySelectorAll('[data-magnetic="true"], .btn-editorial-primary, .btn-editorial-gold, .btn-magnetic');

    magnetics.forEach((el) => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const relX = e.clientX - (rect.left + rect.width / 2);
            const relY = e.clientY - (rect.top + rect.height / 2);

            // Pull strength: 22% of displacement
            const pullX = relX * 0.22;
            const pullY = relY * 0.22;

            el.style.transform = `translate(${pullX}px, ${pullY}px)`;
        });

        el.addEventListener('mouseleave', () => {
            el.style.transition = 'transform 0.45s cubic-bezier(0.16, 1, 0.3, 1)';
            el.style.transform = 'translate(0px, 0px)';
            setTimeout(() => {
                el.style.transition = '';
            }, 450);
        });
    });
}

/* ==========================================================================
   4. 3D CARD PERSPECTIVE TILT & SPECULAR SHEEN
   ========================================================================== */
function initCardTilt() {
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const cards = document.querySelectorAll('.editorial-card, .editorial-card-dark, .tilt-card');

    cards.forEach((card) => {
        // Add sheen reflex container if not present
        if (!card.querySelector('.card-sheen')) {
            const sheen = document.createElement('div');
            sheen.className = 'card-sheen';
            card.appendChild(sheen);
        }

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            // Subtle rotation (max 4.5 degrees)
            const rotateX = ((y - centerY) / centerY) * -4.5;
            const rotateY = ((x - centerX) / centerX) * 4.5;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;

            // Position sheen hotspot
            card.style.setProperty('--sheen-x', `${(x / rect.width) * 100}%`);
            card.style.setProperty('--sheen-y', `${(y / rect.height) * 100}%`);
        });

        card.addEventListener('mouseleave', () => {
            card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease';
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
            setTimeout(() => {
                card.style.transition = '';
            }, 500);
        });
    });
}

/* ==========================================================================
   5. VIEWPORT SCROLL REVEAL & STAGGER OBSERVER
   ========================================================================== */
function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal, .reveal-scale, .reveal-left, .reveal-right');

    if (!('IntersectionObserver' in window)) {
        reveals.forEach((el) => el.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px -30px 0px' }
    );

    reveals.forEach((el) => observer.observe(el));
}

/* ==========================================================================
   6. EDITORIAL NAVBAR SCROLL ADAPTATION
   ========================================================================== */
function initNavbar() {
    const navbar = document.getElementById('navbar');
    const container = document.getElementById('navbar-container');
    if (!navbar) return;

    const onScroll = () => {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
            if (container) {
                container.style.backgroundColor = 'rgba(246, 241, 231, 0.95)';
                container.style.borderColor = 'rgba(70, 124, 120, 0.3)';
                container.style.boxShadow = '0 12px 30px -10px rgba(29, 42, 53, 0.08)';
            }
        } else {
            navbar.classList.remove('scrolled');
            if (container) {
                container.style.backgroundColor = 'rgba(246, 241, 231, 0.8)';
                container.style.borderColor = 'rgba(215, 216, 209, 0.8)';
                container.style.boxShadow = 'none';
            }
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

/* ==========================================================================
   7. MOBILE NAVIGATION OVERLAY
   ========================================================================== */
function initMobileMenu() {
    const toggle = document.getElementById('mobile-toggle');
    const menu = document.getElementById('mobile-menu');
    const close = document.getElementById('mobile-close');
    const links = menu?.querySelectorAll('a');

    if (!toggle || !menu) return;

    const openMenu = () => {
        menu.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
        menu.classList.add('translate-y-0', 'opacity-100');
        document.body.style.overflow = 'hidden';
    };

    const closeMenu = () => {
        menu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
        menu.classList.remove('translate-y-0', 'opacity-100');
        document.body.style.overflow = '';
    };

    toggle.addEventListener('click', openMenu);
    close?.addEventListener('click', closeMenu);
    links?.forEach((link) => link.addEventListener('click', closeMenu));

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menu.classList.contains('opacity-100')) {
            closeMenu();
        }
    });
}

/* ==========================================================================
   8. ACTIVE NAV LINK TRACKING
   ========================================================================== */
function initActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-editorial');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach((section) => {
            const top = section.offsetTop - 140;
            if (window.scrollY >= top) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href && href.endsWith(`#${current}`)) {
                link.classList.add('active');
            }
        });
    }, { passive: true });
}

/* ==========================================================================
   9. REPLAY WELCOME SCREEN BUTTON TRIGGER
   ========================================================================== */
function initWelcomeScreenTriggers() {
    const reopenBtn = document.getElementById('reopen-welcome-btn');
    if (reopenBtn) {
        reopenBtn.addEventListener('click', () => {
            if (typeof window.openWelcomeScreen === 'function') {
                window.openWelcomeScreen();
            }
        });
    }
}
