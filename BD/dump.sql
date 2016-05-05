--
-- PostgreSQL database cluster dump
--

-- Started on 2016-05-04 22:57:10

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE postgres;
ALTER ROLE postgres WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION PASSWORD 'md5b4326be48e3144de59a77eb4fccdb998';






--
-- Database creation
--

CREATE DATABASE customworkflow WITH TEMPLATE = template0 OWNER = postgres;
CREATE DATABASE pb WITH TEMPLATE = template0 OWNER = postgres LC_COLLATE = 'C' LC_CTYPE = 'C';
REVOKE ALL ON DATABASE template1 FROM PUBLIC;
REVOKE ALL ON DATABASE template1 FROM postgres;
GRANT ALL ON DATABASE template1 TO postgres;
GRANT CONNECT ON DATABASE template1 TO PUBLIC;


\connect customworkflow

SET default_transaction_read_only = off;

--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.4
-- Dumped by pg_dump version 9.4.4
-- Started on 2016-05-04 22:57:10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 190 (class 3079 OID 11855)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2079 (class 0 OID 0)
-- Dependencies: 190
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 183 (class 1259 OID 24626)
-- Name: atores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE atores (
    id integer NOT NULL,
    ator character varying
);


ALTER TABLE atores OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 24624)
-- Name: atores_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE atores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE atores_id_seq OWNER TO postgres;

--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 182
-- Name: atores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE atores_id_seq OWNED BY atores.id;


--
-- TOC entry 179 (class 1259 OID 24606)
-- Name: posto_acao; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE posto_acao (
    id integer NOT NULL,
    idposto integer,
    acao character varying,
    goto integer
);


ALTER TABLE posto_acao OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 24604)
-- Name: posto_acao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE posto_acao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE posto_acao_id_seq OWNER TO postgres;

--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 178
-- Name: posto_acao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE posto_acao_id_seq OWNED BY posto_acao.id;


--
-- TOC entry 189 (class 1259 OID 24654)
-- Name: postos_campo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE postos_campo (
    id integer NOT NULL,
    idposto integer,
    campo character varying
);


ALTER TABLE postos_campo OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 24652)
-- Name: postos_campo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE postos_campo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE postos_campo_id_seq OWNER TO postgres;

--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 188
-- Name: postos_campo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE postos_campo_id_seq OWNED BY postos_campo.id;


--
-- TOC entry 187 (class 1259 OID 24643)
-- Name: tecnologias; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tecnologias (
    id integer NOT NULL,
    tecnologia character varying
);


ALTER TABLE tecnologias OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 24641)
-- Name: tecnologias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tecnologias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tecnologias_id_seq OWNER TO postgres;

--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 186
-- Name: tecnologias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tecnologias_id_seq OWNED BY tecnologias.id;


--
-- TOC entry 177 (class 1259 OID 24600)
-- Name: usuario_atores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario_atores (
    id integer NOT NULL,
    idusuario integer,
    idator integer
);


ALTER TABLE usuario_atores OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 24598)
-- Name: usuario_atores_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_atores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuario_atores_id_seq OWNER TO postgres;

--
-- TOC entry 2084 (class 0 OID 0)
-- Dependencies: 176
-- Name: usuario_atores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_atores_id_seq OWNED BY usuario_atores.id;


--
-- TOC entry 173 (class 1259 OID 24580)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    nome character varying
);


ALTER TABLE usuarios OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 24637)
-- Name: usuarios_avaliadores_tecnologias; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuarios_avaliadores_tecnologias (
    id integer NOT NULL,
    idusuario integer,
    idtecnologia integer
);


ALTER TABLE usuarios_avaliadores_tecnologias OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 24635)
-- Name: usuarios_avaliadores_tecnologias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_avaliadores_tecnologias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_avaliadores_tecnologias_id_seq OWNER TO postgres;

--
-- TOC entry 2085 (class 0 OID 0)
-- Dependencies: 184
-- Name: usuarios_avaliadores_tecnologias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_avaliadores_tecnologias_id_seq OWNED BY usuarios_avaliadores_tecnologias.id;


--
-- TOC entry 172 (class 1259 OID 24578)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_id_seq OWNER TO postgres;

--
-- TOC entry 2086 (class 0 OID 0)
-- Dependencies: 172
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- TOC entry 181 (class 1259 OID 24617)
-- Name: workflow; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE workflow (
    id integer NOT NULL,
    workflow character varying,
    posto_inicial integer,
    posto_final integer
);


ALTER TABLE workflow OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 24615)
-- Name: workflow_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE workflow_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workflow_id_seq OWNER TO postgres;

--
-- TOC entry 2087 (class 0 OID 0)
-- Dependencies: 180
-- Name: workflow_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE workflow_id_seq OWNED BY workflow.id;


--
-- TOC entry 175 (class 1259 OID 24589)
-- Name: workflow_postos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE workflow_postos (
    id integer NOT NULL,
    id_workflow integer,
    idator integer,
    posto character varying,
    ordem_cronologica integer,
    sla integer,
    escalonamento character varying
);


ALTER TABLE workflow_postos OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 24587)
-- Name: workflow_postos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE workflow_postos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workflow_postos_id_seq OWNER TO postgres;

--
-- TOC entry 2088 (class 0 OID 0)
-- Dependencies: 174
-- Name: workflow_postos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE workflow_postos_id_seq OWNED BY workflow_postos.id;


--
-- TOC entry 1941 (class 2604 OID 24629)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atores ALTER COLUMN id SET DEFAULT nextval('atores_id_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 24609)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posto_acao ALTER COLUMN id SET DEFAULT nextval('posto_acao_id_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 24657)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY postos_campo ALTER COLUMN id SET DEFAULT nextval('postos_campo_id_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 24646)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tecnologias ALTER COLUMN id SET DEFAULT nextval('tecnologias_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 24603)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario_atores ALTER COLUMN id SET DEFAULT nextval('usuario_atores_id_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 24583)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 1942 (class 2604 OID 24640)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios_avaliadores_tecnologias ALTER COLUMN id SET DEFAULT nextval('usuarios_avaliadores_tecnologias_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 24620)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY workflow ALTER COLUMN id SET DEFAULT nextval('workflow_id_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 24592)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY workflow_postos ALTER COLUMN id SET DEFAULT nextval('workflow_postos_id_seq'::regclass);


--
-- TOC entry 2065 (class 0 OID 24626)
-- Dependencies: 183
-- Data for Name: atores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY atores (id, ator) FROM stdin;
2	avaliador
3	analista selecao
5	gestor selecao
\.


--
-- TOC entry 2089 (class 0 OID 0)
-- Dependencies: 182
-- Name: atores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('atores_id_seq', 84, true);


--
-- TOC entry 2061 (class 0 OID 24606)
-- Dependencies: 179
-- Data for Name: posto_acao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY posto_acao (id, idposto, acao, goto) FROM stdin;
1	1	Lançar	2
2	2	Lançar	3
3	3	Classificar	4
4	4	Designar Gestor	5
5	5	Entrevistado	6
6	5	Voltar para Roteamento	4
7	6	negociar	8
8	6	Reprovado	4
9	7	Feito	0
10	8	fechado	7
11	8	negociacao cancelada	4
12	4	Arquivar	0
\.


--
-- TOC entry 2090 (class 0 OID 0)
-- Dependencies: 178
-- Name: posto_acao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('posto_acao_id_seq', 309, true);


--
-- TOC entry 2071 (class 0 OID 24654)
-- Dependencies: 189
-- Data for Name: postos_campo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY postos_campo (id, idposto, campo) FROM stdin;
154	1	job description
155	2	github
156	2	cv
157	3	senioridade
158	4	gestor
159	5	parecer
160	6	parecer
161	8	dados da negociacao
162	7	checklist executado ?
\.


--
-- TOC entry 2091 (class 0 OID 0)
-- Dependencies: 188
-- Name: postos_campo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('postos_campo_id_seq', 162, true);


--
-- TOC entry 2069 (class 0 OID 24643)
-- Dependencies: 187
-- Data for Name: tecnologias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tecnologias (id, tecnologia) FROM stdin;
2	python
3	ruby
4	javascript
\.


--
-- TOC entry 2092 (class 0 OID 0)
-- Dependencies: 186
-- Name: tecnologias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tecnologias_id_seq', 48, true);


--
-- TOC entry 2059 (class 0 OID 24600)
-- Dependencies: 177
-- Data for Name: usuario_atores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario_atores (id, idusuario, idator) FROM stdin;
50	1	1
51	1	5
52	1	3
53	2	2
54	3	1
55	4	3
56	5	2
57	1	1
58	1	5
59	1	3
60	2	2
61	3	1
62	4	3
63	5	2
64	1	1
65	1	5
66	1	3
67	2	2
68	3	1
69	4	3
70	5	2
71	1	1
72	1	5
73	1	3
74	2	2
75	3	1
76	4	3
77	5	2
78	1	1
79	1	5
80	1	3
81	2	2
82	3	1
83	4	3
84	5	2
\.


--
-- TOC entry 2093 (class 0 OID 0)
-- Dependencies: 176
-- Name: usuario_atores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_atores_id_seq', 84, true);


--
-- TOC entry 2055 (class 0 OID 24580)
-- Dependencies: 173
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios (id, nome) FROM stdin;
1	bruno
2	mario
3	paffi
4	erica
5	daniele
\.


--
-- TOC entry 2067 (class 0 OID 24637)
-- Dependencies: 185
-- Data for Name: usuarios_avaliadores_tecnologias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios_avaliadores_tecnologias (id, idusuario, idtecnologia) FROM stdin;
\.


--
-- TOC entry 2094 (class 0 OID 0)
-- Dependencies: 184
-- Name: usuarios_avaliadores_tecnologias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_avaliadores_tecnologias_id_seq', 36, true);


--
-- TOC entry 2095 (class 0 OID 0)
-- Dependencies: 172
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 55, true);


--
-- TOC entry 2063 (class 0 OID 24617)
-- Dependencies: 181
-- Data for Name: workflow; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY workflow (id, workflow, posto_inicial, posto_final) FROM stdin;
1	recrutamento e slecao de dev	2	7
25	fluxo 2 	\N	\N
\.


--
-- TOC entry 2096 (class 0 OID 0)
-- Dependencies: 180
-- Name: workflow_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('workflow_id_seq', 25, true);


--
-- TOC entry 2057 (class 0 OID 24589)
-- Dependencies: 175
-- Data for Name: workflow_postos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY workflow_postos (id, id_workflow, idator, posto, ordem_cronologica, sla, escalonamento) FROM stdin;
1	1	1	job description	1	0	0
2	1	3	cadastra retorno	2	0	0
3	1	2	classificacao	3	3	bruno.siqueira@walmart.com
4	1	5	roteamento	4	8	bruno.siqueira@walmart.com
5	1	1	entrevista presencial	5	6	bruno.siqueira@walmart.com
6	1	1	entrevistados	6	7	bruno.siqueira@walmart.com
7	1	1	onboarding	8	7	bruno.siqueira@walmart.com
8	1	1	negociar com consultoria	7	7	bruno.siqueira@walmart.com
\.


--
-- TOC entry 2097 (class 0 OID 0)
-- Dependencies: 174
-- Name: workflow_postos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('workflow_postos_id_seq', 272, true);


--
-- TOC entry 2078 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-05-04 22:57:11

 