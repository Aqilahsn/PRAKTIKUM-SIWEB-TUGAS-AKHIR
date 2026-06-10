"use client";
import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { FiSearch, FiGithub, FiExternalLink, FiEye, FiGlobe, FiBarChart2, FiLayout, FiSmartphone } from "react-icons/fi";
import Link from "next/link";
import { projects } from "@/data";

const categories = ["All", "Web App", "Dashboard", "UI Design", "Mobile App"];
const fadeUp = (delay = 0) => ({ initial: { opacity: 0, y: 30 }, whileInView: { opacity: 1, y: 0 }, viewport: { once: true }, transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const } });

const gradients: Record<string, string> = { "Web App": "from-matcha-400 to-pink-500", Dashboard: "from-pink-500 to-matcha-600", "UI Design": "from-pink-300 to-matcha-500", "Mobile App": "from-matcha-500 to-pink-500" };

const categoryIcons: Record<string, React.ReactNode> = {
  "Web App": <FiGlobe size={48} />,
  Dashboard: <FiBarChart2 size={48} />,
  "UI Design": <FiLayout size={48} />,
  "Mobile App": <FiSmartphone size={48} />,
};

export default function Projects() {
  const [search, setSearch] = useState("");
  const [activeCategory, setActiveCategory] = useState("All");
  const filtered = projects.filter((p) => { const mc = activeCategory === "All" || p.category === activeCategory; const ms = p.title.toLowerCase().includes(search.toLowerCase()) || p.tags.some((t) => t.toLowerCase().includes(search.toLowerCase())); return mc && ms; });

  return (
  <section id="projects" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 100% 50%, rgba(132,204,22,0.08) 0%, transparent 60%), transparent" }}>
      <div className="max-w-7xl mx-auto">
        <motion.div {...fadeUp(0)} className="text-center mb-14">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">My Work</p>
          <h2 className="section-title">Projects</h2>
          <p className="section-subtitle font-medium text-pink-800/80">Things I&apos;ve built with love</p>
        </motion.div>

        <motion.div {...fadeUp(0.1)} className="flex flex-col md:flex-row gap-4 mb-10 items-center justify-between">
          <div className="relative w-full md:w-80">
            <FiSearch className="absolute left-4 top-1/2 -translate-y-1/2 text-matcha-500" size={16} />
            <input type="text" placeholder="Search projects..." value={search} onChange={(e) => setSearch(e.target.value)} className="input-luxury pl-11 py-3 text-sm w-full bg-white/90 border-pink-200" />
          </div>
          <div className="flex flex-wrap gap-2 justify-center">
            {categories.map((cat) => (
              <motion.button key={cat} whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }} onClick={() => setActiveCategory(cat)}
                className={`px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 ${activeCategory === cat ? "bg-gradient-to-r from-matcha-500 to-pink-500 text-white shadow-lg shadow-matcha-200" : "glass-card text-pink-900/80 hover:text-pink-950 border border-pink-200 bg-white/70"}`}>
                {cat}
              </motion.button>
            ))}
          </div>
        </motion.div>

        <AnimatePresence mode="wait">
          <motion.div key={activeCategory + search} initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} transition={{ duration: 0.3 }} className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filtered.map((project, i) => (
              <motion.div key={project.id} initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: i * 0.08 }} whileHover={{ y: -8 }} className="glass-card overflow-hidden group relative flex flex-col bg-white/80 border border-pink-200" style={{ boxShadow: "0 10px 30px rgba(132,204,22,0.06)" }}>
                <div className={`relative h-48 bg-gradient-to-br ${gradients[project.category] ?? "from-matcha-500 to-pink-500"} overflow-hidden`}>
                  <div className="absolute inset-0 flex items-center justify-center text-white/20">{categoryIcons[project.category]}</div>
                  <div className="absolute inset-0 bg-gradient-to-t from-pink-950/20 to-transparent" />
                  <div className="absolute top-3 left-3"><span className="tag-badge bg-white/90 text-pink-900 border border-pink-300 font-bold">{project.category}</span></div>
                  {project.featured && (<div className="absolute top-3 right-3"><span className="px-2 py-1 text-xs font-bold rounded-full bg-matcha-500/90 text-white">Featured</span></div>)}
                  <div className="absolute inset-0 bg-pink-950/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-4">
                    <motion.a href={project.github} target="_blank" rel="noopener noreferrer" whileHover={{ scale: 1.1 }} className="p-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white hover:bg-white/20 transition-all" title="GitHub"><FiGithub size={18} /></motion.a>
                    <motion.a href={project.demo} target="_blank" rel="noopener noreferrer" whileHover={{ scale: 1.1 }} className="p-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white hover:bg-white/20 transition-all" title="Live Demo"><FiExternalLink size={18} /></motion.a>
                    <motion.div whileHover={{ scale: 1.1 }}><Link href={`/projects/${project.id}`} className="p-3 rounded-full bg-matcha-500/60 backdrop-blur-sm border border-matcha-400/40 text-white hover:bg-matcha-500/80 transition-all" title="View Details"><FiEye size={18} /></Link></motion.div>
                  </div>
                </div>
                <div className="p-5 flex flex-col gap-3 flex-1">
                  <div>
                    <h3 className="font-display font-bold text-pink-950 text-xl group-hover:text-gradient transition-all duration-300">{project.title}</h3>
                    <p className="text-pink-900/70 text-sm mt-1 leading-relaxed font-medium">{project.shortDesc}</p>
                  </div>
                  <div className="flex flex-wrap gap-2 mt-auto">{project.tags.map((tag) => (<span key={tag} className="tag-badge bg-pink-50 text-pink-700 border border-pink-200">{tag}</span>))}</div>
                  <p className="text-pink-600/50 text-xs font-semibold">{project.year}</p>
                  <div className="flex gap-2 pt-3 border-t border-pink-100 mt-2">
                    <a href={project.github} target="_blank" rel="noopener noreferrer" className="flex items-center gap-1.5 text-xs text-pink-700/80 hover:text-pink-950 transition-colors font-semibold"><FiGithub size={13} /> GitHub</a>
                    <span className="text-pink-200">·</span>
                    <a href={project.demo} target="_blank" rel="noopener noreferrer" className="flex items-center gap-1.5 text-xs text-pink-700/80 hover:text-pink-950 transition-colors font-semibold"><FiExternalLink size={13} /> Live Demo</a>
                    <span className="text-pink-200">·</span>
                    <Link href={`/projects/${project.id}`} className="flex items-center gap-1.5 text-xs text-pink-800 hover:text-pink-950 transition-colors font-bold"><FiEye size={13} /> Detail</Link>
                  </div>
                </div>
              </motion.div>
            ))}
          </motion.div>
        </AnimatePresence>

        {filtered.length === 0 && (
          <div className="text-center py-20">
            <FiSearch size={48} className="text-matcha-300 mx-auto mb-4" />
            <p className="text-pink-700/60 font-semibold">No projects found. Try another search.</p>
          </div>
        )}
      </div>
    </section>
  );
}
