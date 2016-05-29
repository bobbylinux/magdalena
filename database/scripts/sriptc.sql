-- Database: votazioni

-- DROP DATABASE votazioni;

CREATE DATABASE votazioni
  WITH OWNER = votazioni
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'C'
       LC_CTYPE = 'C'
       CONNECTION LIMIT = -1;
GRANT CONNECT, TEMPORARY ON DATABASE votazioni TO public;
GRANT ALL ON DATABASE votazioni TO votazioni;

-- Schema: public

-- DROP SCHEMA public;

CREATE SCHEMA public
  AUTHORIZATION postgres;

GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;
COMMENT ON SCHEMA public
  IS 'standard public schema';

  -- Function: getastenutipercdc(integer, character varying)

-- DROP FUNCTION getastenutipercdc(integer, character varying);

CREATE OR REPLACE FUNCTION getastenutipercdc(ac_rif integer, ac_cdc character varying)
  RETURNS bigint AS
$BODY$select count(distinct ta001_soci.c_soc)
from ta001_soci
inner join ta003_cdc
on ta003_cdc.c_cdc = ta001_soci.c_cdc
where ta003_cdc.c_cdc = ac_cdc
and ta001_soci.c_soc not in (select c_soc from ts001_voti where ac_rif = 1)$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getastenutipercdc(integer, character varying)
  OWNER TO postgres;
-- Function: getastenutipersede(integer, character varying)

-- DROP FUNCTION getastenutipersede(integer, character varying);

CREATE OR REPLACE FUNCTION getastenutipersede(ac_rif integer, ac_sed character varying)
  RETURNS bigint AS
$BODY$select count(distinct ta001_soci.c_soc)
from ta001_soci
inner join ta002_sedi
on ta002_sedi.c_sed = ta001_soci.c_sed
where ta002_sedi.c_sed = ac_sed
and ta001_soci.c_soc not in (select c_soc from ts001_voti where ac_rif = 1)$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getastenutipersede(integer, character varying)
  OWNER TO postgres;
-- Function: getastenutitotali(integer)

-- DROP FUNCTION getastenutitotali(integer);

CREATE OR REPLACE FUNCTION getastenutitotali(ac_rif integer)
  RETURNS bigint AS
$BODY$select count(distinct ta001_soci.c_soc)
from ta001_soci
where ta001_soci.c_soc not in (select c_soc from ts001_voti where ac_rif = 1)$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getastenutitotali(integer)
  OWNER TO postgres;
-- Function: getvotantipercdc(integer, character varying)

-- DROP FUNCTION getvotantipercdc(integer, character varying);

CREATE OR REPLACE FUNCTION getvotantipercdc(ac_rif integer, ac_cdc character varying)
  RETURNS bigint AS
$BODY$select count(distinct ts001_voti.c_soc)
from ts001_voti
inner join ta001_soci
on ta001_soci.c_soc = ts001_voti.c_soc
inner join ta003_cdc
on ta003_cdc.c_cdc = ta001_soci.c_cdc
where ta003_cdc.c_cdc = ac_cdc
and ts001_voti.c_rif = ac_rif;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getvotantipercdc(integer, character varying)
  OWNER TO postgres;
-- Function: getvotantipersede(integer, character varying)

-- DROP FUNCTION getvotantipersede(integer, character varying);

CREATE OR REPLACE FUNCTION getvotantipersede(ac_rif integer, ac_sed character varying)
  RETURNS bigint AS
$BODY$select count(distinct ts001_voti.c_soc)
from ts001_voti
inner join ta001_soci
on ta001_soci.c_soc = ts001_voti.c_soc
inner join ta002_sedi
on ta002_sedi.c_sed = ta001_soci.c_sed
where ta002_sedi.c_sed = ac_sed
and ts001_voti.c_rif = ac_rif;$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getvotantipersede(integer, character varying)
  OWNER TO postgres;
-- Function: getvotantitotali(integer)

-- DROP FUNCTION getvotantitotali(integer);

CREATE OR REPLACE FUNCTION getvotantitotali(ac_rif integer)
  RETURNS bigint AS
$BODY$select count(distinct ts001_voti.c_soc)
from ts001_voti
inner join ta001_soci
on ta001_soci.c_soc = ts001_voti.c_soc
where ts001_voti.c_rif = ac_rif;$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION getvotantitotali(integer)
  OWNER TO postgres;
-- Sequence: ts001_voti_c_vot_seq

-- DROP SEQUENCE ts001_voti_c_vot_seq;

CREATE SEQUENCE ts001_voti_c_vot_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE ts001_voti_c_vot_seq
  OWNER TO votazioni;
-- Sequence: ts002_dat_rif_c_rif_seq

-- DROP SEQUENCE ts002_dat_rif_c_rif_seq;

CREATE SEQUENCE ts002_dat_rif_c_rif_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 4
  CACHE 1;
ALTER TABLE ts002_dat_rif_c_rif_seq
  OWNER TO votazioni;
-- Sequence: ts004_candidati_id_seq

-- DROP SEQUENCE ts004_candidati_id_seq;

CREATE SEQUENCE ts004_candidati_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 34
  CACHE 1;
ALTER TABLE ts004_candidati_id_seq
  OWNER TO votazioni;
-- Sequence: users_id_seq

-- DROP SEQUENCE users_id_seq;

CREATE SEQUENCE users_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 2152
  CACHE 1;
ALTER TABLE users_id_seq
  OWNER TO votazioni;

-- Table: migrations

-- DROP TABLE migrations;

CREATE TABLE migrations
(
  migration character varying(255) NOT NULL,
  batch integer NOT NULL
)
WITH (
  OIDS=FALSE
);
ALTER TABLE migrations
  OWNER TO votazioni;

  -- Table: ta003_cdc

-- DROP TABLE ta003_cdc;

CREATE TABLE ta003_cdc
(
  c_cdc character varying(3) NOT NULL,
  t_sed character varying(100) NOT NULL,
  CONSTRAINT ta003_cdc_pkey PRIMARY KEY (c_cdc)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ta003_cdc
  OWNER TO votazioni;
-- Table: ta002_sedi

-- DROP TABLE ta002_sedi;

CREATE TABLE ta002_sedi
(
  c_sed character varying(3) NOT NULL,
  t_sed character varying(100) NOT NULL,
  CONSTRAINT ta002_sedi_pkey PRIMARY KEY (c_sed),
  CONSTRAINT ta002_sedi_c_sed_unique UNIQUE (c_sed),
  CONSTRAINT ta002_sedi_t_sed_unique UNIQUE (t_sed)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ta002_sedi
  OWNER TO votazioni;

-- Table: ts002_dat_rif

-- DROP TABLE ts002_dat_rif;

CREATE TABLE ts002_dat_rif
(
  c_rif serial NOT NULL,
  d_rif_ini timestamp(0) without time zone NOT NULL,
  d_rif_fin timestamp(0) without time zone NOT NULL,
  t_des character varying(500),
  n_vot_min integer NOT NULL DEFAULT 1,
  n_vot_max integer NOT NULL DEFAULT 9,
  f_att character varying(1) NOT NULL DEFAULT 'N'::character varying,
  CONSTRAINT ts002_dat_rif_pkey PRIMARY KEY (c_rif)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ts002_dat_rif
  OWNER TO votazioni;

-- Table: ta001_soci

-- DROP TABLE ta001_soci;

CREATE TABLE ta001_soci
(
  c_soc character varying(10) NOT NULL,
  c_bdg character varying(8) NOT NULL,
  t_cgn character varying(100) NOT NULL,
  t_nom character varying(100) NOT NULL,
  c_cdc character varying(10) NOT NULL,
  c_sed character varying(10) NOT NULL,
  CONSTRAINT ta001_soci_pkey PRIMARY KEY (c_soc),
  CONSTRAINT ta001_soci_c_cdc_foreign FOREIGN KEY (c_cdc)
      REFERENCES ta003_cdc (c_cdc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ta001_soci_c_sed_foreign FOREIGN KEY (c_sed)
      REFERENCES ta002_sedi (c_sed) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ta001_soci_c_bdg_unique UNIQUE (c_bdg),
  CONSTRAINT ta001_soci_c_soc_unique UNIQUE (c_soc)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ta001_soci
  OWNER TO votazioni;
-- Table: ts001_voti

-- DROP TABLE ts001_voti;

CREATE TABLE ts001_voti
(
  c_vot serial NOT NULL,
  c_soc character varying(10) NOT NULL,
  c_soc_vot character varying(10) NOT NULL,
  d_vot timestamp(0) without time zone NOT NULL,
  c_rif integer NOT NULL,
  CONSTRAINT ts001_voti_pkey PRIMARY KEY (c_vot),
  CONSTRAINT fk_ts001_ts002 FOREIGN KEY (c_rif)
      REFERENCES ts002_dat_rif (c_rif) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ts001_voti
  OWNER TO votazioni;
-- Table: ts004_candidati
CREATE INDEX fki_ts001_ts002
  ON ts001_voti
  USING btree
  (c_rif);

-- DROP TABLE ts004_candidati;

CREATE TABLE ts004_candidati
(
  id serial NOT NULL,
  c_soc character varying(10) NOT NULL,
  c_rif integer NOT NULL,
  CONSTRAINT ts004_candidati_pkey PRIMARY KEY (id),
  CONSTRAINT ts004_candidati_c_rif_foreign FOREIGN KEY (c_rif)
      REFERENCES ts002_dat_rif (c_rif) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT ts004_candidati_c_soc_foreign FOREIGN KEY (c_soc)
	  REFERENCES ta001_soci (c_soc) MATCH SIMPLE
	  ON UPDATE NO ACTION ON DELETE NO ACTION,    
  CONSTRAINT ts004_candidati_c_soc_c_rif_unique UNIQUE (c_soc, c_rif),
  CONSTRAINT ts004_candidati_c_soc_unique UNIQUE (c_soc)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ts004_candidati
  OWNER TO votazioni;
-- Table: users

-- DROP TABLE users;

CREATE TABLE users
(
  id serial NOT NULL,
  username character varying(128) NOT NULL,
  password character varying(64) NOT NULL,
  admin boolean NOT NULL DEFAULT false,
  remember_token character varying(100),
  c_soc character varying(10) NOT NULL,
  created_at timestamp(0) without time zone NOT NULL,
  updated_at timestamp(0) without time zone NOT NULL,
  active boolean NOT NULL DEFAULT true,
  CONSTRAINT users_pkey PRIMARY KEY (id),
  CONSTRAINT users_c_soc_foreign FOREIGN KEY (c_soc)
      REFERENCES ta001_soci (c_soc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT users_username_unique UNIQUE (username)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE users
  OWNER TO votazioni;









