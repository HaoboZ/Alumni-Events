copy_haobo:
	scp -r * hzhang@linux.scudc.scu.edu:/webpages/hzhang/COEN174

copy_alfredo:
	scp -r * asepulvedavanhoorde@linux.scudc.scu.edu:/webpages/asepulvedavanhoorde/COEN174

clean_haobo:
	rm -rf /webpages/hzhang/COEN174/*

clean_alfredo:
	rm -rf /webpages/asepulvedavanhoorde/COEN174/*

activate_haobo:
	chmod -R 715 /webpages/hzhang/*

activate_alfredo:
	chmod -R 715 /webpages/asepulvedavanhoorde/*
