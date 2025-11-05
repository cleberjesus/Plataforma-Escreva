import sys
import io
import json
import re

from argumentacao import analisar_argumentacao
from coesao import analisar_coesao
from estrutura import analisar_estrutura

from collections import defaultdict

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

def extrai_competencia(msg):
    m = re.match(r"Competência (\d+):", msg)
    return int(m.group(1)) if m else 99

if __name__ == "__main__":
    texto = sys.stdin.buffer.read().decode('utf-8').strip()

    feedbacks_por_competencia = defaultdict(list)

    for msg in analisar_argumentacao(texto) + analisar_coesao(texto) + analisar_estrutura(texto):
        comp = extrai_competencia(msg)
        feedbacks_por_competencia[f"competencia_{comp}"].append(msg)

    for comp, mensagens in feedbacks_por_competencia.items():
        feedbacks_por_competencia[comp] = list(dict.fromkeys(mensagens))

    resultado_json = json.dumps({"feedback": dict(feedbacks_por_competencia)}, ensure_ascii=False)
    print(resultado_json)