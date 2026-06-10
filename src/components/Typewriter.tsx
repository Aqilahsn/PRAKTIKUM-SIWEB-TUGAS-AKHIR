"use client";
import { useEffect, useState } from "react";

interface TypewriterProps {
  words: string[];
  className?: string;
  speed?: number;
  deleteSpeed?: number;
  pauseTime?: number;
}

export default function Typewriter({
  words,
  className = "",
  speed = 100,
  deleteSpeed = 60,
  pauseTime = 2000,
}: TypewriterProps) {
  const [displayed, setDisplayed] = useState("");
  const [wordIndex, setWordIndex] = useState(0);
  const [charIndex, setCharIndex] = useState(0);
  const [deleting, setDeleting] = useState(false);
  const [paused, setPaused] = useState(false);

  useEffect(() => {
    if (paused) {
      const timeout = setTimeout(() => {
        setPaused(false);
        setDeleting(true);
      }, pauseTime);
      return () => clearTimeout(timeout);
    }

    const current = words[wordIndex];

    if (!deleting) {
      if (charIndex < current.length) {
        const timeout = setTimeout(() => {
          setDisplayed(current.slice(0, charIndex + 1));
          setCharIndex((c) => c + 1);
        }, speed);
        return () => clearTimeout(timeout);
      } else {
        setPaused(true);
      }
    } else {
      if (charIndex > 0) {
        const timeout = setTimeout(() => {
          setDisplayed(current.slice(0, charIndex - 1));
          setCharIndex((c) => c - 1);
        }, deleteSpeed);
        return () => clearTimeout(timeout);
      } else {
        setDeleting(false);
        setWordIndex((w) => (w + 1) % words.length);
      }
    }
  }, [charIndex, deleting, paused, wordIndex, words, speed, deleteSpeed, pauseTime]);

  return (
    <span className={className}>
      {displayed}
      <span className="inline-block w-0.5 h-[1em] bg-pink-400 ml-1 align-middle animate-pulse" />
    </span>
  );
}
