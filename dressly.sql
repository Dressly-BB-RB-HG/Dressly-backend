-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 28. 22:23
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `dressly`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategorias`
--

CREATE TABLE `kategorias` (
  `kategoria_id` bigint(20) UNSIGNED NOT NULL,
  `ruhazat_kat` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `kategorias`
--

INSERT INTO `kategorias` (`kategoria_id`, `ruhazat_kat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rövid ujjú póló', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 'Hosszú ujjú póló', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 'Pulóver', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(4, 'Zokni', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(5, 'Kabát', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(6, 'Dzseki', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(7, 'Galléros póló', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(8, 'Mezek', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(9, 'Farmernadrág', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(10, 'Szabadidőnadrág', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(11, 'Rövidnadrág', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(12, 'Nadrág', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(13, 'Sapka', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kedvenceks`
--

CREATE TABLE `kedvenceks` (
  `felhasznalo` bigint(20) UNSIGNED NOT NULL,
  `modell` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `kedvenceks`
--

INSERT INTO `kedvenceks` (`felhasznalo`, `modell`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 1, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 3, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 5, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 6, NULL, '2025-04-08 12:44:56', '2025-04-08 12:44:56'),
(3, 7, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosars`
--

CREATE TABLE `kosars` (
  `felhasznalo` bigint(20) UNSIGNED NOT NULL,
  `termek` bigint(20) UNSIGNED NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `kosars`
--

INSERT INTO `kosars` (`felhasznalo`, `termek`, `mennyiseg`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '2025-04-01 12:54:00', '2025-04-01 12:54:00'),
(3, 3, 1, '2025-03-27 17:47:22', '2025-03-27 17:47:22');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_07_082038_create_kategorias_table', 1),
(5, '2025_01_07_082039_create_modells_table', 1),
(6, '2025_01_07_082040_create_termeks_table', 1),
(7, '2025_01_07_082122_create_rendeles_table', 1),
(8, '2025_01_07_082201_create_szall__csomags_table', 1),
(9, '2025_01_07_082236_create_rendeles_tetels_table', 1),
(10, '2025_01_07_082249_create_termek_ars_table', 1),
(11, '2025_01_07_082303_create_kedvenceks_table', 1),
(12, '2025_01_07_082333_create_kosars_table', 1),
(13, '2025_01_14_082639_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `modells`
--

CREATE TABLE `modells` (
  `modell_id` bigint(20) UNSIGNED NOT NULL,
  `kategoria` bigint(20) UNSIGNED NOT NULL,
  `tipus` char(1) NOT NULL,
  `gyarto` varchar(255) NOT NULL,
  `kep` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `modells`
--

INSERT INTO `modells` (`modell_id`, `kategoria`, `tipus`, `gyarto`, `kep`, `created_at`, `updated_at`) VALUES
(1, 1, 'F', 'Nike', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/38f07fd9-b7f8-4203-bde0-53d037c6f6f0/M+NSW+TEE+M90+OC+LBR+SEGA.png', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 3, 'N', 'Nike', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2a9a11b5-754a-4a69-84d9-eb11fefe910d/W+NSW+PHNX+FLC+OS+PO+HOODIE.png', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 3, 'U', 'Nike', 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/4a6d71f5-e43c-4e09-b851-c7ef8cfacd88/U+NK+SABRINA+SIGNATURE+HDY.png', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(4, 5, 'N', 'The North Face', 'https://assets.thenorthface.com/images/t_img/c_pad,b_white,f_auto,h_1510,w_1300,e_sharpen:70/NF0A88Z1JK3-HERO/NF0A88Z1JK3-in-TNF-Black.png', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(5, 4, 'U', 'Puma', 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_550,h_550/global/906110/04/fnd/EEA/fmt/png/PUMA-Unisex-Short-Crew-Socks-3-Pack', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(6, 8, 'F', 'Adidas', 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/00807ed890c5497f89bbcd4bae02a308_9366/Manchester_United_24-25_Third_Jersey_White_IY7806_HM1.jpg', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(7, 2, 'N', 'The North Face', 'https://img2.ans-media.com/i/840x1260/AW24-BUD05F-99X_F1.jpg@webp?v=1721193971', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(8, 1, 'F', 'Ralph Lauren', 'https://img01.ztat.net/article/spp-media-p1/f7c4b084ab704316ad0654eb892e20a7/bbb7c8e0a2144c5599435ab76c609879.jpg?imwidth=762', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(9, 3, 'N', 'Ralph Lauren', 'https://img01.ztat.net/article/spp-media-p1/32d5c535f8bb41f7a089acfa8f2722f4/2c8bd3ab05b0476fbc09e45d55a89be5.jpg?imwidth=762', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(10, 1, 'N', 'Boss', ' https://img01.ztat.net/article/spp-media-p1/47f1e006ca934f62a976bc37f2adeb16/18f012cc3db746f0b97e8a792f5cce7d.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(11, 9, 'N', 'Boss', ' https://img01.ztat.net/article/spp-media-p1/e00da3e84079427ebd6acd135c4557b7/2b859b5c821b4c2ba04db8897357d3a1.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(12, 11, 'F', 'Boss', ' https://img01.ztat.net/article/spp-media-p1/6f8dbc76dc3a433c9e53b621234e8db7/3d635fbb6b4b481ea19208e44662f98c.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(13, 13, 'U', 'Puma', 'https://img01.ztat.net/article/spp-media-p1/14d265ca7b9d4e668c62363df1b371be/6833c58b40894a35a7e078520e8c55e8.jpg?imwidth=762&filter=packshot', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(14, 5, 'F', 'Tommy Hilfiger', ' https://img01.ztat.net/article/spp-media-p1/8fdb15e9ed3744f088d1b3a454ae58a5/dc79eedb2f0a4904aafa2dad86fce4be.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(15, 9, 'F', 'Tommy Hilfiger', ' https://img01.ztat.net/article/spp-media-p1/f2e91e5868114ad0992568b05a51ad4c/31b12ba5ef5f4d73a162949a03489f06.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(16, 10, 'N', 'Adidas', ' https://img01.ztat.net/article/spp-media-p1/a0fb4aea792e4f52a6e1b1c39d1fa209/d3d91a16e4a9477ca631720bb18953fe.jpg?imwidth=1800', '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles`
--

CREATE TABLE `rendeles` (
  `rendeles_szam` bigint(20) UNSIGNED NOT NULL,
  `felhasznalo` bigint(20) UNSIGNED NOT NULL,
  `rendeles_datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `fizetve_e` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `rendeles`
--

INSERT INTO `rendeles` (`rendeles_szam`, `felhasznalo`, `rendeles_datum`, `fizetve_e`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-03-27 10:24:54', 0, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 3, '2025-03-27 10:24:54', 0, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 3, '2024-12-21 23:00:00', 0, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(4, 3, '2024-12-19 23:00:00', 0, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(5, 3, '2025-03-27 10:24:54', 0, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles_tetels`
--

CREATE TABLE `rendeles_tetels` (
  `rendeles` bigint(20) UNSIGNED NOT NULL,
  `termek` bigint(20) UNSIGNED NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `rendeles_tetels`
--

INSERT INTO `rendeles_tetels` (`rendeles`, `termek`, `mennyiseg`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 3, 5, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 3, 5, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 3, 2, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(4, 1, 15, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(5, 2, 10, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szall__csomags`
--

CREATE TABLE `szall__csomags` (
  `csomag_id` bigint(20) UNSIGNED NOT NULL,
  `rendeles` bigint(20) UNSIGNED NOT NULL,
  `szallito` char(3) NOT NULL,
  `csomag_allapot` varchar(15) NOT NULL,
  `szall_datum` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `szall__csomags`
--

INSERT INTO `szall__csomags` (`csomag_id`, `rendeles`, `szallito`, `csomag_allapot`, `szall_datum`, `created_at`, `updated_at`) VALUES
(1, 2, 'GLS', 'futarnal', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 1, 'MPL', 'futarnal', NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termeks`
--

CREATE TABLE `termeks` (
  `termek_id` bigint(20) UNSIGNED NOT NULL,
  `modell` bigint(20) UNSIGNED NOT NULL,
  `szin` varchar(255) NOT NULL,
  `meret` char(3) NOT NULL,
  `keszlet` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `termeks`
--

INSERT INTO `termeks` (`termek_id`, `modell`, `szin`, `meret`, `keszlet`, `ar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Barna', 'M', 34, 7999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, 2, 'Szürke', 'L', 20, 10999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(3, 3, 'Rózsaszín', 'S', 8, 8999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(4, 4, 'Fekete', 'M', 40, 73999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(5, 5, 'Fehér', 'M', 120, 3890, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(6, 6, 'Fehér', 'M', 32, 30999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(7, 7, 'Fekete', 'L', 20, 9999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(8, 7, 'Fekete', 'M', 25, 9999, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(9, 8, 'Beige', 'L', 21, 39990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(10, 9, 'Beige', 'S', 21, 49990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(11, 10, 'Fehér', 'S', 25, 29990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(12, 11, 'Kék', 'M', 25, 27990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(13, 12, 'Beige', 'M', 25, 19990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(14, 13, 'Lila', 'M', 25, 9990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(15, 14, 'Barna', 'L', 25, 59990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(16, 15, 'Kék', 'S', 25, 29990, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(17, 16, 'Fekete', 'S', 25, 19990, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek_ars`
--

CREATE TABLE `termek_ars` (
  `termek` bigint(20) UNSIGNED NOT NULL,
  `dtol` date NOT NULL,
  `uj_ar` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `termek_ars`
--

INSERT INTO `termek_ars` (`termek`, `dtol`, `uj_ar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2024-01-01', 12990, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54'),
(2, '2024-02-01', 14990, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `k_nev` varchar(255) NOT NULL,
  `v_nev` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `hirlevel` int(11) NOT NULL DEFAULT 0,
  `varos` varchar(255) NOT NULL,
  `iranyitoszam` int(11) NOT NULL DEFAULT 0,
  `utca` varchar(255) NOT NULL,
  `hazszam` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `k_nev`, `v_nev`, `password`, `role`, `hirlevel`, `varos`, `iranyitoszam`, `utca`, `hazszam`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, 'Admin', 'Admin', '$2y$12$dGqFiqbPv/DL2zFjGtM2jODlmVVOsmEtJsL23r82sJZxxieHO6Rmu', 1, 0, 'Budapest', 2030, 'Lajos utca', 72, NULL, '2025-03-27 09:24:53', '2025-03-27 09:24:53'),
(2, 'raktaros', 'raktaros@raktaros.com', NULL, 'Raktaros', 'Raktaros', '$2y$12$oTcGteQIXO/z55qeXZarXuyLBtqyH7SXVMDTiOrX7Z6jyZCLO6r1a', 2, 0, 'Budapest', 2030, 'Lajos utca', 71, NULL, '2025-03-27 09:24:53', '2025-03-27 09:24:53'),
(3, 'felhasznalo', 'felhasznalo@felhasznalo.com', NULL, 'Felhasznalo', 'Felhasznalo', '$2y$12$oP/E5wDX5Mmwlnw4JDb/0elq15sJlmD1BVwILihPMRi301ndODbv.', 0, 0, 'Budapest', 2030, 'Lajos utca', 70, NULL, '2025-03-27 09:24:54', '2025-03-27 09:24:54');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategorias`
--
ALTER TABLE `kategorias`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- A tábla indexei `kedvenceks`
--
ALTER TABLE `kedvenceks`
  ADD PRIMARY KEY (`felhasznalo`,`modell`),
  ADD KEY `kedvenceks_modell_foreign` (`modell`);

--
-- A tábla indexei `kosars`
--
ALTER TABLE `kosars`
  ADD PRIMARY KEY (`felhasznalo`,`termek`),
  ADD KEY `kosars_termek_foreign` (`termek`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `modells`
--
ALTER TABLE `modells`
  ADD PRIMARY KEY (`modell_id`),
  ADD KEY `modells_kategoria_foreign` (`kategoria`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`rendeles_szam`),
  ADD KEY `rendeles_felhasznalo_foreign` (`felhasznalo`);

--
-- A tábla indexei `rendeles_tetels`
--
ALTER TABLE `rendeles_tetels`
  ADD KEY `rendeles_tetels_rendeles_foreign` (`rendeles`),
  ADD KEY `rendeles_tetels_termek_foreign` (`termek`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `szall__csomags`
--
ALTER TABLE `szall__csomags`
  ADD PRIMARY KEY (`csomag_id`),
  ADD KEY `szall__csomags_rendeles_foreign` (`rendeles`);

--
-- A tábla indexei `termeks`
--
ALTER TABLE `termeks`
  ADD PRIMARY KEY (`termek_id`),
  ADD KEY `termeks_modell_foreign` (`modell`);

--
-- A tábla indexei `termek_ars`
--
ALTER TABLE `termek_ars`
  ADD PRIMARY KEY (`termek`,`dtol`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kategorias`
--
ALTER TABLE `kategorias`
  MODIFY `kategoria_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `modells`
--
ALTER TABLE `modells`
  MODIFY `modell_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `rendeles_szam` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `szall__csomags`
--
ALTER TABLE `szall__csomags`
  MODIFY `csomag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `termeks`
--
ALTER TABLE `termeks`
  MODIFY `termek_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kedvenceks`
--
ALTER TABLE `kedvenceks`
  ADD CONSTRAINT `kedvenceks_felhasznalo_foreign` FOREIGN KEY (`felhasznalo`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kedvenceks_modell_foreign` FOREIGN KEY (`modell`) REFERENCES `modells` (`modell_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `kosars`
--
ALTER TABLE `kosars`
  ADD CONSTRAINT `kosars_felhasznalo_foreign` FOREIGN KEY (`felhasznalo`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kosars_termek_foreign` FOREIGN KEY (`termek`) REFERENCES `termeks` (`termek_id`);

--
-- Megkötések a táblához `modells`
--
ALTER TABLE `modells`
  ADD CONSTRAINT `modells_kategoria_foreign` FOREIGN KEY (`kategoria`) REFERENCES `kategorias` (`kategoria_id`);

--
-- Megkötések a táblához `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_felhasznalo_foreign` FOREIGN KEY (`felhasznalo`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `rendeles_tetels`
--
ALTER TABLE `rendeles_tetels`
  ADD CONSTRAINT `rendeles_tetels_rendeles_foreign` FOREIGN KEY (`rendeles`) REFERENCES `rendeles` (`rendeles_szam`),
  ADD CONSTRAINT `rendeles_tetels_termek_foreign` FOREIGN KEY (`termek`) REFERENCES `termeks` (`termek_id`);

--
-- Megkötések a táblához `szall__csomags`
--
ALTER TABLE `szall__csomags`
  ADD CONSTRAINT `szall__csomags_rendeles_foreign` FOREIGN KEY (`rendeles`) REFERENCES `rendeles` (`rendeles_szam`);

--
-- Megkötések a táblához `termeks`
--
ALTER TABLE `termeks`
  ADD CONSTRAINT `termeks_modell_foreign` FOREIGN KEY (`modell`) REFERENCES `modells` (`modell_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `termek_ars`
--
ALTER TABLE `termek_ars`
  ADD CONSTRAINT `termek_ars_termek_foreign` FOREIGN KEY (`termek`) REFERENCES `termeks` (`termek_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
