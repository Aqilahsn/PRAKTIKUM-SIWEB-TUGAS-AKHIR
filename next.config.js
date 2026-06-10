/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    remotePatterns: [
      { protocol: "https", hostname: "**" },
    ],
    unoptimized: true,
  },
  experimental: {
    optimizeCss: false,
  },
};

module.exports = nextConfig;
