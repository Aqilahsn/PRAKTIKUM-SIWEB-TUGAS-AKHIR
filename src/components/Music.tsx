"use client";
import { useState, useEffect, useRef, useCallback } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { FiPlay, FiPause, FiSkipForward, FiSkipBack, FiVolume2, FiVolumeX } from "react-icons/fi";
import Image from "next/image";
import { favoriteMusic } from "@/data";

declare global {
  interface Window { YT: any; onYouTubeIframeAPIReady: () => void; }
}

const songs = favoriteMusic.songs;
const fadeUp = (delay = 0) => ({
  initial: { opacity: 0, y: 30 },
  whileInView: { opacity: 1, y: 0 },
  viewport: { once: true },
  transition: { duration: 0.7, delay, ease: [0.22, 1, 0.36, 1] as const },
});

export default function Music() {
  const [currentIdx, setCurrentIdx] = useState(0);
  const [isPlaying, setIsPlaying] = useState(false);
  const [progress, setProgress] = useState(0);
  const [duration, setDuration] = useState(0);
  const [isMuted, setIsMuted] = useState(false);
  const [ytReady, setYtReady] = useState(false);
  const playerRef = useRef<any>(null);
  const intervalRef = useRef<NodeJS.Timeout | null>(null);
  const iframeContainerRef = useRef<HTMLDivElement>(null);
  const currentSong = songs[currentIdx];

  useEffect(() => {
    if (typeof window === "undefined") return;
    if (window.YT && window.YT.Player) { setYtReady(true); return; }
    const tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    document.head.appendChild(tag);
    window.onYouTubeIframeAPIReady = () => setYtReady(true);
  }, []);

  useEffect(() => {
    if (!ytReady || !iframeContainerRef.current) return;
    if (playerRef.current) { try { playerRef.current.destroy(); } catch (_) {} playerRef.current = null; }
    const container = document.createElement("div");
    container.id = `yt-player-${currentIdx}`;
    iframeContainerRef.current.innerHTML = "";
    iframeContainerRef.current.appendChild(container);
    playerRef.current = new window.YT.Player(container.id, {
      height: "1", width: "1", videoId: currentSong.youtubeId,
      playerVars: { autoplay: isPlaying ? 1 : 0, controls: 0, rel: 0, modestbranding: 1, playsinline: 1, origin: typeof window !== "undefined" ? window.location.origin : "" },
      events: {
        onReady: (e: any) => { try { e.target.unMute(); e.target.setVolume(100); if (isMuted) e.target.mute(); if (isPlaying) e.target.playVideo(); } catch {} setDuration(e.target.getDuration() || 0); },
        onStateChange: (e: any) => { if (e.data === 0) handleNext(); if (e.data === 1) { try { if (!isMuted) { e.target.unMute(); e.target.setVolume(100); } } catch {} } },
      },
    });
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [ytReady, currentIdx]);

  useEffect(() => {
    if (intervalRef.current) clearInterval(intervalRef.current);
    if (isPlaying) {
      intervalRef.current = setInterval(() => {
        if (playerRef.current?.getCurrentTime) { const c = playerRef.current.getCurrentTime() || 0; const t = playerRef.current.getDuration() || 1; setProgress((c / t) * 100); setDuration(t); }
      }, 500);
    }
    return () => { if (intervalRef.current) clearInterval(intervalRef.current); };
  }, [isPlaying]);

  const handlePlay = useCallback(() => {
    if (!playerRef.current) return;
    if (isPlaying) { playerRef.current.pauseVideo?.(); setIsPlaying(false); }
    else { try { playerRef.current.unMute?.(); playerRef.current.setVolume?.(100); } catch {} playerRef.current.playVideo?.(); setIsPlaying(true); }
  }, [isPlaying]);

  const handleNext = useCallback(() => {
    setIsPlaying(false); setProgress(0); setCurrentIdx((i) => (i + 1) % songs.length);
    setTimeout(() => { try { playerRef.current?.unMute?.(); playerRef.current?.setVolume?.(100); } catch {} playerRef.current?.playVideo?.(); setIsPlaying(true); }, 1000);
  }, []);

  const handlePrev = useCallback(() => {
    setIsPlaying(false); setProgress(0); setCurrentIdx((i) => (i === 0 ? songs.length - 1 : i - 1));
    setTimeout(() => { try { playerRef.current?.unMute?.(); playerRef.current?.setVolume?.(100); } catch {} playerRef.current?.playVideo?.(); setIsPlaying(true); }, 1000);
  }, []);

  const handleSeek = (e: React.MouseEvent<HTMLDivElement>) => { const rect = e.currentTarget.getBoundingClientRect(); const ratio = (e.clientX - rect.left) / rect.width; playerRef.current?.seekTo?.(ratio * duration, true); setProgress(ratio * 100); };
  const toggleMute = () => { if (isMuted) { playerRef.current?.unMute?.(); playerRef.current?.setVolume?.(100); } else { playerRef.current?.mute?.(); } setIsMuted(!isMuted); };
  const fmt = (pct: number) => { const s = (pct / 100) * duration; return `${Math.floor(s / 60)}:${String(Math.floor(s % 60)).padStart(2, "0")}`; };
  const bars = Array.from({ length: 16 }, (_, i) => i);

  return (
  <section id="music" className="relative py-28 px-6 overflow-hidden" style={{ background: "radial-gradient(ellipse at 30% 50%, rgba(132,204,22,0.08) 0%, transparent 60%), radial-gradient(ellipse at 70% 50%, rgba(244,114,182,0.08) 0%, transparent 60%), transparent" }}>
      <div ref={iframeContainerRef} className="absolute opacity-0 pointer-events-none" style={{ width: 1, height: 1, overflow: "hidden" }} aria-hidden="true" />
      <div className="max-w-7xl mx-auto">
        <motion.div {...fadeUp(0)} className="text-center mb-16">
          <p className="text-matcha-600 text-sm font-semibold tracking-widest uppercase mb-3">Vibes Only</p>
          <h2 className="section-title">{favoriteMusic.title}</h2>
          <p className="section-subtitle font-medium text-pink-800/80">{favoriteMusic.subtitle}</p>
        </motion.div>

        <div className="grid lg:grid-cols-3 gap-8">
          {/* Player */}
          <motion.div {...fadeUp(0.1)} className="lg:col-span-1 glass-card rounded-3xl p-6 border border-pink-200 bg-white/90 relative overflow-hidden" style={{ boxShadow: "0 10px 30px rgba(132,204,22,0.06)" }}>
            <div className="absolute inset-0 opacity-10" style={{ background: "radial-gradient(ellipse at 50% 30%, #84cc16, transparent)" }} />
            <div className="relative z-10 flex justify-center mb-6">
              <motion.div animate={isPlaying ? { rotate: 360 } : {}} transition={{ duration: 8, repeat: Infinity, ease: "linear" }} className="w-44 h-44 rounded-full flex items-center justify-center relative overflow-hidden" style={{ background: `linear-gradient(135deg, ${currentSong.color}33, #fff0f6)`, boxShadow: isPlaying ? `0 0 50px ${currentSong.color}44` : `0 0 20px ${currentSong.color}11`, border: `3px solid ${currentSong.color}44` }}>
                {currentSong.albumImage ? (<Image src={currentSong.albumImage} alt={`${currentSong.title} cover`} fill className="object-cover rounded-full" sizes="176px" />) : (<div className="w-8 h-8 rounded-full z-10" style={{ background: currentSong.color, opacity: 0.7 }} />)}
                <div className="absolute w-6 h-6 rounded-full bg-white/90 z-20 border-2 border-gray-200" />
              </motion.div>
            </div>
            <AnimatePresence mode="wait">
              <motion.div key={currentIdx} initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -10 }} className="relative z-10 text-center mb-5">
                <h3 className="font-display font-bold text-pink-950 text-xl">{currentSong.title}</h3>
                <p className="text-pink-700 text-sm mt-1 font-semibold">{currentSong.artist}</p>
                <p className="text-pink-600/50 text-xs font-semibold">{currentSong.album}</p>
              </motion.div>
            </AnimatePresence>
            <div className="relative z-10 mb-4">
              <div className="w-full h-2 bg-pink-100 rounded-full overflow-hidden cursor-pointer" onClick={handleSeek}>
                <motion.div className="h-full rounded-full" style={{ width: `${progress}%`, background: `linear-gradient(90deg, #84cc16, ${currentSong.color})` }} />
              </div>
              <div className="flex justify-between mt-1.5">
                <span className="text-pink-700/60 text-xs font-semibold">{fmt(progress)}</span>
                <span className="text-pink-700/60 text-xs font-semibold">{currentSong.duration}</span>
              </div>
            </div>
            <div className="relative z-10 flex items-center justify-between px-2">
              <motion.button whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }} onClick={toggleMute} className="p-2 text-pink-700/60 hover:text-pink-950 transition-colors">
                {isMuted ? <FiVolumeX size={18} /> : <FiVolume2 size={18} />}
              </motion.button>
              <div className="flex items-center gap-4">
                <motion.button whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }} onClick={handlePrev} className="p-2 text-pink-700/60 hover:text-pink-950 transition-colors"><FiSkipBack size={20} /></motion.button>
                <motion.button whileHover={{ scale: 1.08 }} whileTap={{ scale: 0.92 }} onClick={handlePlay} className="w-14 h-14 rounded-full flex items-center justify-center shadow-lg" style={{ background: `linear-gradient(135deg, #84cc16, ${currentSong.color})`, boxShadow: `0 4px 20px rgba(132,204,22,0.3)` }}>
                  {isPlaying ? <FiPause size={22} className="text-white" /> : <FiPlay size={22} className="text-white ml-0.5" />}
                </motion.button>
                <motion.button whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }} onClick={handleNext} className="p-2 text-pink-700/60 hover:text-pink-950 transition-colors"><FiSkipForward size={20} /></motion.button>
              </div>
              <div className="w-8" />
            </div>
            <AnimatePresence>
              {isPlaying && (<div className="relative z-10 flex items-end justify-center gap-0.5 h-8 mt-5">{bars.map((b) => (<motion.div key={b} animate={{ height: [3, 8 + Math.random() * 20, 3] }} transition={{ duration: 0.3 + Math.random() * 0.4, repeat: Infinity, delay: b * 0.04 }} className="w-1 rounded-full" style={{ background: `linear-gradient(180deg, #84cc16, ${currentSong.color})` }} />))}</div>)}
            </AnimatePresence>
          </motion.div>

          {/* Playlist */}
          <motion.div {...fadeUp(0.2)} className="lg:col-span-1 flex flex-col gap-3">
            <p className="text-matcha-600 text-sm uppercase tracking-widest mb-2 font-bold">Playlist</p>
            {songs.map((song, i) => (
              <motion.button key={song.id} whileHover={{ scale: 1.02, x: 4 }} whileTap={{ scale: 0.98 }}
                onClick={() => { setCurrentIdx(i); setProgress(0); setTimeout(() => { try { playerRef.current?.unMute?.(); playerRef.current?.setVolume?.(100); } catch {} playerRef.current?.playVideo?.(); setIsPlaying(true); }, 1000); }}
                className={`flex items-center gap-4 p-4 rounded-2xl text-left transition-all duration-300 ${currentIdx === i ? "glass-card border border-matcha-300 bg-white/90" : "glass-card-light border border-pink-200/50 bg-white/50 hover:bg-white/80"}`}>
                <div className="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden bg-white/30 relative" style={{ boxShadow: currentIdx === i ? `0 0 16px ${song.color}44` : "none" }}>
                  {song.albumImage ? (<Image src={song.albumImage} alt={`${song.title} cover`} fill className="object-cover rounded-xl" sizes="56px" />) : (<div className="w-5 h-5 rounded-full" style={{ background: song.color, opacity: 0.8 }} />)}
                </div>
                <div className="flex-1 min-w-0">
                  <p className="text-pink-950 text-sm font-bold truncate">{song.title}</p>
                  <p className="text-pink-700/70 text-xs font-semibold truncate">{song.artist}</p>
                </div>
                <div className="text-right flex-shrink-0">
                  <p className="text-pink-600/60 text-xs font-bold">{song.duration}</p>
                  {currentIdx === i && isPlaying && (<motion.div className="flex gap-0.5 mt-1 justify-end" animate={{ opacity: [0.5, 1, 0.5] }} transition={{ duration: 1, repeat: Infinity }}>{[1, 2, 3].map((b) => (<div key={b} className="w-0.5 h-3 rounded-full" style={{ background: song.color }} />))}</motion.div>)}
                </div>
              </motion.button>
            ))}
          </motion.div>

          {/* Artists */}
          <motion.div {...fadeUp(0.3)} className="lg:col-span-1 flex flex-col gap-4">
            <p className="text-matcha-600 text-sm uppercase tracking-widest mb-2 font-bold">Favorite Artists</p>
            {favoriteMusic.favoriteArtists.map((artist, i) => (
              <motion.div key={artist.name} initial={{ opacity: 0, x: 20 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }} transition={{ delay: 0.3 + i * 0.08 }} whileHover={{ scale: 1.03, y: -2 }} className="flex items-center gap-4 p-4 glass-card-light rounded-2xl border border-pink-200 bg-white/70">
                <div className="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 border" style={{ background: `${artist.color}15`, borderColor: `${artist.color}40`, boxShadow: `0 0 12px ${artist.color}10` }}>
                  <div className="w-4 h-4 rounded-full" style={{ background: artist.color }} />
                </div>
                <div><p className="text-pink-950 font-bold text-sm">{artist.name}</p><p className="text-pink-700/60 text-xs font-semibold">{artist.genre}</p></div>
                <div className="ml-auto w-2 h-2 rounded-full flex-shrink-0" style={{ background: artist.color }} />
              </motion.div>
            ))}
            <div className="glass-card-light rounded-2xl p-4 border border-pink-200 bg-white/50 mt-2">
              <p className="text-pink-700/50 text-xs text-center leading-relaxed font-semibold">Music plays via YouTube embed.<br />Make sure you&apos;re connected to the internet.</p>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
