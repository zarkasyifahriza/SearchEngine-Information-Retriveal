#!/usr/bin/python3

import sys
import json

# Argumen check
if len(sys.argv) != 4:
    print(json.dumps({"error": "Penggunaan: query.py [list.json] [n] [query]"}))
    sys.exit(1)

query = sys.argv[3].lower()  # Pastikan query dalam huruf kecil
n = int(sys.argv[2])

# Buka file JSON
with open(sys.argv[1], 'r') as indexdb:
    indexFile = json.load(indexdb)

# Query
list_doc = []
for doc in indexFile:
    # Filter berdasarkan query (misalnya, tahun, judul, atau tentang)
    if query in str(doc.get("Tahun", "")).lower() or \
       query in doc.get("Title", "").lower() or \
       query in doc.get("Tentang", "").lower():
        list_doc.append(doc)

# Sorting list descending berdasarkan score (jika ada)
result = []
for data in sorted(list_doc, key=lambda k: k.get('wish_bt', 0), reverse=True)[:n]:
    result.append({
        "url": data.get("wrapper_URL", ""),
        "score": data.get("wish_bt", 0),
        "title": data.get("Title", "No Title"),
        "description": data.get("Tentang", "No Description"),
        "Nomor": data.get("Nomor", "Tidak tersedia")
			
    })

# Output as JSON
print(json.dumps(result))