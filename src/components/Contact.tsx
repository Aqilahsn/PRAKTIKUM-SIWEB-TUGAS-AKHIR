"use client";
import { useState } from "react";
import { motion } from "framer-motion";
import { FiSend, FiInstagram, FiGithub, FiLinkedin, FiMessageCircle, FiMail, FiMapPin, FiPhone } from "react-icons/fi";
import { profile } from "@/data";

const fadeUp = (delay = 0) => ({ initial: { opacity: 0, y: 30 }, whileInView: { opacity: 1, y: 0 }, viewport: { once: true }, transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const } });

const socials = [
  { icon: FiInstagram, label: "Instagram", href: profile.instagram, color: "#e1306c" },
  { icon: FiGithub, label: "GitHub", href: profile.github, color: "#181717" },
  { icon: FiLinkedin, label: "LinkedIn", href: profile.linkedin, color: "#0a66c2" },
  { icon: FiMessageCircle, label: "WhatsApp", href: profile.whatsapp, color: "#25d366" },
];

export default function Contact() {
  const [form, setForm] = useState({ name: "", email: "", subject: "", message: "" });
  const [sending, setSending] = useState(false);
  const [sent, setSent] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => { e.preventDefault(); setSending(true); await new Promise((r) => setTimeout(r, 1800)); setSending(false); setSent(true); setForm({ name: "", email: "", subject: "", message: "" }); setTimeout(() => setSent(false), 4000); };

  return (
  <section id="contact" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 50% 100%, rgba(132,204,22,0.08) 0%, transparent 60%), transparent" }}>
      <div className="orb w-96 h-96 left-1/2 -translate-x-1/2 -top-20 opacity-20" style={{ background: "radial-gradient(circle, rgba(132,204,22,0.3), transparent)" }} />

      <div className="max-w-6xl mx-auto relative z-10">
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">Say Hello</p>
          <h2 className="section-title">Contact Me</h2>
          <p className="section-subtitle font-medium text-pink-800/80">Let&apos;s work together and create something beautiful</p>
        </motion.div>

        <div className="grid lg:grid-cols-5 gap-10">
          <motion.div {...fadeUp(0.1)} className="lg:col-span-2 flex flex-col gap-6">
            <div className="glass-card rounded-2xl p-6 border border-pink-200 bg-white/90">
              <h3 className="font-display font-bold text-pink-950 text-xl mb-6">Get In Touch</h3>
              <div className="flex flex-col gap-5">
                {[
                  { icon: FiMail, label: "Email", value: profile.email },
                  { icon: FiPhone, label: "Phone", value: profile.phone },
                  { icon: FiMapPin, label: "Location", value: profile.location },
                ].map((item) => (
                  <div key={item.label} className="flex items-start gap-4">
                    <div className="w-10 h-10 rounded-xl bg-matcha-50 border border-matcha-200 flex items-center justify-center flex-shrink-0">
                      <item.icon className="text-matcha-600" size={16} />
                    </div>
                    <div>
                      <p className="text-pink-700/60 text-xs font-semibold">{item.label}</p>
                      <p className="text-pink-950 text-sm font-bold">{item.value}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="glass-card rounded-2xl p-6 border border-pink-200 bg-white/90">
              <p className="text-matcha-700 text-sm font-bold uppercase tracking-widest mb-4">Social Media</p>
              <div className="grid grid-cols-2 gap-3">
                {socials.map((s) => (
                  <motion.a key={s.label} href={s.href} target="_blank" rel="noopener noreferrer" whileHover={{ scale: 1.05, y: -2 }} whileTap={{ scale: 0.97 }} className="flex items-center gap-3 p-3 rounded-xl glass-card-light border border-pink-200 hover:border-matcha-300 transition-all duration-300 group bg-white/50">
                    <s.icon size={18} style={{ color: s.color }} className="transition-transform group-hover:scale-110" />
                    <span className="text-pink-900/80 text-sm font-semibold group-hover:text-pink-950">{s.label}</span>
                  </motion.a>
                ))}
              </div>
            </div>
          </motion.div>

          <motion.div {...fadeUp(0.2)} className="lg:col-span-3">
            <div className="glass-card rounded-3xl p-8 border border-pink-200 bg-white/90">
              <h3 className="font-display font-bold text-pink-950 text-xl mb-6">Send a Message</h3>
              <form onSubmit={handleSubmit} className="flex flex-col gap-5">
                <div className="grid md:grid-cols-2 gap-5">
                  <div>
                    <label className="text-matcha-700 text-xs font-bold uppercase tracking-widest mb-2 block">Name</label>
                    <input type="text" required placeholder="Your name..." value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} className="input-luxury" />
                  </div>
                  <div>
                    <label className="text-matcha-700 text-xs font-bold uppercase tracking-widest mb-2 block">Email</label>
                    <input type="email" required placeholder="your@email.com" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} className="input-luxury" />
                  </div>
                </div>
                <div>
                  <label className="text-matcha-700 text-xs font-bold uppercase tracking-widest mb-2 block">Subject</label>
                  <input type="text" required placeholder="What's it about?" value={form.subject} onChange={(e) => setForm({ ...form, subject: e.target.value })} className="input-luxury" />
                </div>
                <div>
                  <label className="text-matcha-700 text-xs font-bold uppercase tracking-widest mb-2 block">Message</label>
                  <textarea required rows={5} placeholder="Tell me about your project or just say hi!" value={form.message} onChange={(e) => setForm({ ...form, message: e.target.value })} className="input-luxury resize-none" />
                </div>
                <motion.button type="submit" whileHover={{ scale: 1.02 }} whileTap={{ scale: 0.97 }} disabled={sending} className="relative flex items-center justify-center gap-3 py-4 rounded-2xl font-semibold text-white overflow-hidden transition-all duration-300 disabled:opacity-70" style={{ background: sent ? "linear-gradient(135deg, #16a34a, #15803d)" : "linear-gradient(135deg, #84cc16, #f472b6)", boxShadow: sent ? "0 4px 20px rgba(22,163,74,0.3)" : "0 4px 20px rgba(132,204,22,0.3)" }}>
                  {!sent && !sending && (<div className="absolute inset-0 shimmer-bg" />)}
                  {sending ? (<><motion.div animate={{ rotate: 360 }} transition={{ duration: 1, repeat: Infinity, ease: "linear" }} className="w-5 h-5 border-2 border-white/30 border-t-white rounded-full" />Sending...</>) : sent ? (<>Message Sent!</>) : (<><FiSend size={18} />Send Message</>)}
                </motion.button>
              </form>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
