"use client";
import { motion } from "framer-motion";
import { notFound } from "next/navigation";
import Link from "next/link";
import { FiArrowLeft, FiGithub, FiExternalLink, FiCalendar, FiTag } from "react-icons/fi";
import { projects } from "@/data";

const gradients: Record<string, string> = {
  "Web App":    "from-pink-300 via-rose-400 to-pink-500",
  Dashboard:    "from-rose-400 via-pink-400 to-rose-500",
  "UI Design":  "from-pink-200 via-rose-300 to-pink-400",
  "Mobile App": "from-rose-300 via-pink-400 to-rose-500",
};

const emojiMap: Record<string, string> = {
  "Web App": "🌐", Dashboard: "📊", "UI Design": "🎨", "Mobile App": "📱",
};

export default function ProjectDetail({ params }: { params: { id: string } }) {
  const project = projects.find((p) => p.id === params.id);
  if (!project) notFound();

  return (
  <div className="min-h-screen pt-20" style={{ background: 'transparent' }}>
      {/* Hero banner */}
      <div
        className={`relative h-72 md:h-96 bg-gradient-to-br ${gradients[project.category] ?? "from-pink-300 to-rose-500"} overflow-hidden flex items-center justify-center`}
      >
        {/* Decorative orbs */}
        <div className="absolute inset-0 opacity-30"
          style={{ background: "radial-gradient(ellipse at 30% 50%, rgba(244,114,182,0.4), transparent 60%)" }} />
        <div className="absolute inset-0 opacity-20"
          style={{ background: "radial-gradient(ellipse at 70% 50%, rgba(155,28,28,0.2), transparent 60%)" }} />

        {/* Big emoji */}
        <motion.span
          initial={{ opacity: 0, scale: 0.5 }}
          animate={{ opacity: 0.15, scale: 1 }}
          transition={{ duration: 1 }}
          className="absolute text-[200px] select-none pointer-events-none"
        >
          {emojiMap[project.category]}
        </motion.span>

        <div className="relative z-10 text-center px-6">
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
          >
            <span className="tag-badge mb-4 inline-block bg-white/90 text-pink-900 border border-pink-300 font-bold">{project.category}</span>
          </motion.div>
          <motion.h1
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.1 }}
            className="font-display font-black text-pink-950 text-4xl md:text-6xl text-shadow-pink"
          >
            {project.title}
          </motion.h1>
          <motion.p
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: 0.3 }}
            className="text-pink-900/80 mt-3 text-lg font-semibold"
          >
            {project.shortDesc}
          </motion.p>
        </div>

        {/* Bottom fade */}
          <div className="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-transparent to-transparent" />
      </div>

      {/* Content */}
      <div className="max-w-5xl mx-auto px-6 py-12">
        {/* Back button */}
        <motion.div
          initial={{ opacity: 0, x: -20 }}
          animate={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.5 }}
          className="mb-10"
        >
          <Link
            href="/#projects"
            className="inline-flex items-center gap-2 text-pink-700/80 hover:text-pink-950 transition-colors group font-bold"
          >
            <FiArrowLeft className="group-hover:-translate-x-1 transition-transform" size={18} />
            Back to Projects
          </Link>
        </motion.div>

        <div className="grid lg:grid-cols-3 gap-10">
          {/* Main content */}
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.2 }}
            className="lg:col-span-2 flex flex-col gap-8"
          >
            {/* Description */}
            <div className="glass-card rounded-3xl p-8 border border-pink-200 bg-white/90">
              <h2 className="font-display font-bold text-pink-950 text-2xl mb-4">
                About This Project
              </h2>
              <p className="text-pink-900/80 leading-relaxed text-base font-medium">
                {project.description}
              </p>
            </div>

            {/* Gallery */}
            <div>
              <h2 className="font-display font-bold text-pink-950 text-xl mb-4">
                Gallery
              </h2>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                {[...Array(3)].map((_, i) => (
                  <motion.div
                    key={i}
                    whileHover={{ scale: 1.03 }}
                    className={`aspect-video rounded-2xl overflow-hidden bg-gradient-to-br ${gradients[project.category] ?? "from-pink-300 to-rose-450"} flex items-center justify-center cursor-pointer border border-pink-200`}
                  >
                    <span className="text-4xl opacity-20">
                      {emojiMap[project.category]}
                    </span>
                  </motion.div>
                ))}
              </div>
            </div>

            {/* Tech stack */}
            <div className="glass-card rounded-3xl p-6 border border-pink-200 bg-white/90">
              <h2 className="font-display font-bold text-pink-950 text-xl mb-4">
                Tech Stack Used
              </h2>
              <div className="flex flex-wrap gap-3">
                {project.tags.map((tag) => (
                  <motion.span
                    key={tag}
                    whileHover={{ scale: 1.1, y: -2 }}
                    className="px-4 py-2 rounded-full glass-card-light border border-pink-200 text-pink-700 bg-white text-sm font-bold shadow-sm"
                  >
                    {tag}
                  </motion.span>
                ))}
              </div>
            </div>
          </motion.div>

          {/* Sidebar */}
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.3 }}
            className="flex flex-col gap-5"
          >
            {/* Project info */}
            <div className="glass-card rounded-3xl p-6 border border-pink-200 bg-white/90">
              <h3 className="font-display font-bold text-pink-950 text-lg mb-5">
                Project Info
              </h3>
              <div className="flex flex-col gap-4">
                <div className="flex items-center gap-3">
                  <div className="w-8 h-8 rounded-lg bg-pink-50 border border-pink-200 flex items-center justify-center">
                    <FiCalendar className="text-pink-600" size={14} />
                  </div>
                  <div>
                    <p className="text-pink-700/60 text-xs font-bold">Year</p>
                    <p className="text-pink-955 text-sm font-bold">{project.year}</p>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <div className="w-8 h-8 rounded-lg bg-pink-50 border border-pink-200 flex items-center justify-center">
                    <FiTag className="text-pink-600" size={14} />
                  </div>
                  <div>
                    <p className="text-pink-700/60 text-xs font-bold">Category</p>
                    <p className="text-pink-955 text-sm font-bold">{project.category}</p>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <div className="w-8 h-8 rounded-lg bg-pink-50 border border-pink-200 flex items-center justify-center">
                    <span className="text-xs">{emojiMap[project.category]}</span>
                  </div>
                  <div>
                    <p className="text-pink-700/60 text-xs font-bold">Type</p>
                    <p className="text-pink-955 text-sm font-bold">
                      {project.featured ? "Featured Project" : "Personal Project"}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* CTA buttons */}
            <div className="flex flex-col gap-3">
              <motion.a
                href={project.demo}
                target="_blank"
                rel="noopener noreferrer"
                whileHover={{ scale: 1.03 }}
                whileTap={{ scale: 0.97 }}
                className="flex items-center justify-center gap-2 py-3.5 rounded-2xl font-semibold text-white transition-all duration-300"
                style={{
                  background: "linear-gradient(135deg, #db2777, #800020)",
                  boxShadow: "0 4px 20px rgba(219,39,119,0.3)",
                }}
              >
                <FiExternalLink size={18} />
                Live Demo
              </motion.a>
              <motion.a
                href={project.github}
                target="_blank"
                rel="noopener noreferrer"
                whileHover={{ scale: 1.03 }}
                whileTap={{ scale: 0.97 }}
                className="flex items-center justify-center gap-2 py-3.5 rounded-2xl font-bold text-pink-700 border border-pink-300 hover:bg-pink-100/35 transition-all duration-300 bg-white"
              >
                <FiGithub size={18} />
                View on GitHub
              </motion.a>
              <Link
                href="/#projects"
                className="flex items-center justify-center gap-2 py-3 rounded-2xl text-pink-700/60 text-sm hover:text-pink-950 transition-colors font-semibold"
              >
                <FiArrowLeft size={14} />
                Back to All Projects
              </Link>
            </div>

            {/* Tags */}
            <div className="glass-card rounded-3xl p-5 border border-pink-200 bg-white/90">
              <p className="text-pink-700/60 text-xs uppercase tracking-widest mb-3 font-bold">
                Tags
              </p>
              <div className="flex flex-wrap gap-2">
                {project.tags.map((tag) => (
                  <span key={tag} className="tag-badge bg-pink-50 text-pink-700 border border-pink-200 font-bold">{tag}</span>
                ))}
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </div>
  );
}
